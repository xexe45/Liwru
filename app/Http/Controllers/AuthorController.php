<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorSaveRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\VueTables\EloquentVueTables;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view()
    {
        return view('admin.authors');
    }

    public function authorsJson()
    {
        if(request()->ajax()) {
			$vueTables = new EloquentVueTables;
			$data = $vueTables->get(new Author, ['id','name','created_at'], []);
			return response()->json($data);
		}
		return abort(401);
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
    public function store(AuthorSaveRequest $request)
    {
        $name = $request->name;

        $autor = Author::create(
            [
                'name' => $name,
                'slug' => str_slug($name)
            ]
        );

        if($autor){
            return response($autor,Response::HTTP_CREATED);
        }

        $error = ["error" => "No se pudo registrar"];
        return response(json_encode($error),Response::HTTP_BAD_REQUEST);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorUpdateRequest $request, Author $author)
    {
        $name = $request->name;
        $author->name = $name;
        $author->slug = str_slug($name);
        $author->save();
        return; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        //
    }
}
