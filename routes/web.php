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
Auth::routes();

Route::get('/', function () {
    return view('blog');
});

Route::group(['middleware' => 'auth'], function() {
		Route::get('/home', 'HomeController@index')->name('home');

		Route::resource('/category','categoryController');

		Route::resource('/tag','tagController');

		Route::get('/post/trash', 'postController@trash_post')->name('post.trash');

		Route::get('/post/restore/{id}', 'postController@restore')->name('post.restore');

		Route::delete('/post/kill/{id}', 'postController@kill')->name('post.kill');

		Route::resource('/post','postController');

		Route::resource('/user','UserController');
	}
);




