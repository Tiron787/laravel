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

Route::get('/', 'PostController@index');

Route::get('post/', 'PostController@index')->name('post.index');
Route::get('post/create', 'PostController@create')->name('post.create');
Route::get('post/show/{id}', 'PostController@show')->name('post.show');// параметры {}
Route::get('post/edit/{id}', 'PostController@edit')->name('post.edit');//
Route::post('post/', 'PostController@store')->name('post.store');   //запись информации в новом посте
Route::patch('post/show/{id}', 'PostController@update')->name('post.update'); //patch изменяет сущест. запись
Route::delete('post/{id}', 'PostController@destroy')->name('post.destroy');

/*Route::get('/', function () {
    return view('test');
});*/


