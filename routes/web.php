<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/images/{path}/{attachment}', function($path, $attachment) {
	$file = sprintf('storage/%s/%s', $path, $attachment);
	if(File::exists($file)) {
        $img = Image::make($file)->resize(150, 150);
		return $img->response();
	}
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/subir', 'BookController@subir')->name('book.new');
    
    Route::group(['prefix' => 'perfil'], function() {
        Route::get('/libros-subidos', 'UserController@librosSubidos')->name('subidos.list');
    });
    

    Route::group(['prefix' => 'administracion'], function () {
        Route::get('/usuarios','UserController@view')->name('users.view');
        Route::get('/categorias','CategoryController@view')->name('categories.view');
        Route::get('/autores','AuthorController@view')->name('authors.view');
    });

    Route::group(['prefix' => 'users'], function() {
        Route::post('/','UserController@store')->name('users.new');
    });

    Route::group(['prefix' => 'categories'], function() {
        Route::post('/','CategoryController@store')->name('categories.new');
        Route::put('/{category}','CategoryController@update')->name('categories.edit');
    });

    Route::group(['prefix' => 'authors'], function() {
        Route::post('/','AuthorController@store')->name('authors.new');
        Route::put('/{author}','AuthorController@update')->name('authors.edit');
    });

    
    Route::group(['prefix' => 'books'], function () {
        Route::post('/', 'BookController@store')->name('books.new');
        Route::post('/user','BookController@storeUser')->name('books.user.new');
    });

    Route::group(['prefix' => 'books-pivot'], function () {
        Route::get('/{id}','BookController@showPivot')->name('books.pivot.show');
        Route::put('/{id}','BookController@updatePivot')->name('books.pivot.update');
        Route::delete('/{id}','BookController@deletePivot')->name('books.pivot.delete');
    });
    

    Route::group(['prefix' => 'json'], function () {
        Route::get('/users','UserController@usersJson')->name('users.json');
        Route::get('/categories','CategoryController@categoriesJson')->name('categories.json');
        Route::get('/authors','AuthorController@authorsJson')->name('authors.json');
    });

    Route::group(['prefix' => 'search'], function () {
        Route::get('/books','BookController@search')->name('books.search');
        Route::get('/categories','CategoryController@search')->name('categories.search');
        Route::get('/codes/{code}','BookController@getByCode')->name('code.search');
    });
    
});


Route::get('/perfil',function(){
    return view('user.profile');
});
