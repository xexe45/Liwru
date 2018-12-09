<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book_user = \DB::table('book_user')->select('book_id')->where('status','<>','2')->get();
        
        $ids = [];

        foreach ($book_user as $key => $value) {
            $ids[] = $value->book_id;
        }

        $books = Book::with(['authors','categories'])->whereIn('id',$ids)->paginate();
    
        
        return view('home', ['books' => $books]);
    }
}
