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
    return view('public.index');
});

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/{anypath}', 'HomeController@index')->where('path', '.*');
Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/category','CategoryController@index')->name('category.index');
    Route::get('/add-category','CategoryController@add')->name('category.add');
    Route::post('/store-category','CategoryController@store')->name('category.store');
    Route::get('/remove-category/{id}','CategoryController@delete')->name('category.delete');
    Route::get('/edit-category/{id}','CategoryController@edit')->name('category.edit');
    Route::post('/update-category/{id}','CategoryController@update')->name('category.update');
    Route::post('/categories-remove/','CategoryController@deleteItems')->name('category.deleteditems');
    Route::post('/categories-change-status/','CategoryController@ChangeStatus')->name('category.change.status');
    Route::get('/active-category','CategoryController@getActive')->name('getActive.Category');

    Route::get('/post','PostController@post')->name('post.index');
    Route::get('/remove-post/{id}','PostController@delete')->name('post.delete');
    Route::post('/remove-selected-posts/','PostController@deleteItems')->name('post.deleteditems');
    Route::post('/store-post','PostController@store')->name('store.post');
    Route::get('/edit-post/{id}','PostController@editpost')->name('edit.post');
    Route::post('/update-post/{id}','PostController@update')->name('update.post');
//Route::post('/post-change-status/','PostController@changeStatus')->name('post.change.status');
});
Route::get('/blogPost','BlogController@post')->name('blog.post');
Route::get('/single-blogpost/{id}','BlogController@singlepost')->name('blog.single.post');
Route::get('/active-category/','BlogController@blogCategory')->name('blog.category');
Route::get('/latestpost/','BlogController@latestPost')->name('blog.latestPost');
Route::get('/category-post/{id}','BlogController@categoryPost')->name('blog.categorypost');
Route::get('/search','BlogController@search');




