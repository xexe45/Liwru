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
        $img = Image::make($file)->resize(200, 200);
		return $img->response();
	}
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'administracion'], function () {
        Route::get('/usuarios','UserController@view')->name('users.view');
        Route::get('/categorias','CategoryController@view')->name('categories.view');
    });

    Route::group(['prefix' => 'users'], function() {
        Route::post('/','UserController@store')->name('users.new');
    });

    Route::group(['prefix' => 'categories'], function() {
        Route::post('/','CategoryController@store')->name('categories.new');
        Route::put('/{category}','CategoryController@update')->name('categories.edit');
    });

    Route::group(['prefix' => 'json'], function () {
        Route::get('/users','UserController@usersJson')->name('users.json');
        Route::get('/categories','CategoryController@categoriesJson')->name('categories.json');
    });
    
});

Route::get('/subir',function(){
    return view('subir.subir');
});
Route::get('/perfil',function(){
    return view('user.profile');
});
