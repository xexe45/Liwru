<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Http\Requests\BookSaveRequest;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{

    public function subir()
    {
        return view('subir.subir');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookSaveRequest $request)
    {
        $autores = explode(",",$request->autor_id);
        $categorias = explode(",",$request->category_id);
        $user = auth()->user();

        

        try{
            /**
             * Empezar transacción
             */
            \DB::beginTransaction();

            /**
            * Registro de Libro
            */
            $picture = Helper::uploadFile( "imagen", 'books');

            $book = new Book;
            $book->isbn = $request->isbn;
            $book->title = $request->title;
            $book->picture = $picture;
            $book->liwru_code = 'dscxcsffd';
            $book->slug = str_slug($request->title);
            $book->save();

            /**
             * Actualizamos el código único liwu
            */
            $random = rand();
            $code = $book->id."LIWRU".$random;
            $book->fill(['liwru_code' => $code])->save();

            /**
             * Registro de Autores del libro
            */
            $book->authors()->attach($autores);

            /**
             * Registro de Categorías del libro
            */
            $book->categories()->attach($categorias);

            /**
             * Registrar libro al usuario
            */
            \DB::table('book_user')->insert(
                [
                    'book_id' => $book->id, 
                    'user_id' => $user->id,
                    'description' => $request->descripcion,
                    'condicion' => $request->condicion
                ]
            );

            $data = $book;

            $success = true;

        }catch( \Exception $e ){

            $data = [$e->getMessage()];
            $success = false;
            \DB::rollBack();

        }

        if( $success ) {
            \DB::commit();
            return response($data,Response::HTTP_CREATED);
        }else{
            return response($data,Response::HTTP_BAD_REQUEST);
        }
        
              
    }

    public function search(Request $request)
    {
        $q = $request->query('q');
        $authors = \DB::table('authors')
                ->select('id','name')
                ->where('name', 'like', '%'.$q.'%')
                ->get();

        return $authors;
    }

    public function getByCode($code)
    {
        $book = Book::where('liwru_code', $code)->first();
        
        if(!$book){
            return response()->json([
                'ok' => false
            ]);
        }

        return response()->json([
            'book' => $book,
            'ok' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
