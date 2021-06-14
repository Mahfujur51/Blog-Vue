<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/{anypath}', 'HomeController@index')->where('path', '.*');

Route::get('/category','CategoryController@index')->name('category.index');
Route::get('/add-category','CategoryController@add')->name('category.add');
Route::post('/store-category','CategoryController@store')->name('category.store');
Route::get('/remove-category/{id}','CategoryController@delete')->name('category.delete');
Route::get('/edit-category/{id}','CategoryController@edit')->name('category.edit');
Route::post('/update-category/{id}','CategoryController@update')->name('category.update');
Route::post('/categories-remove/','CategoryController@deleteItems')->name('category.update');
Route::post('/categories-change-status/','CategoryController@ChangeStatus')->name('category.change.status');

Route::get('/post','PostController@post')->name('post.index');
Route::get('/remove-post/{id}','PostController@delete')->name('post.delete');

