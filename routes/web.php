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

// Authentication
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// posts
Route::group(['prefix' => 'posts'], function (){
    Route::get('/', 'PostsController@showList');
    Route::get('/category/{$categoryName}', 'PostsController@showCategory');
    Route::get('/detail-{id}.html', 'PostsController@showDetail');

});
// posts
Route::group(['prefix' => 'posts'], function (){
    Route::get('/', 'PostsController@showList');
    Route::get('/category/{$categoryName}', 'PostsController@showCategory');
    Route::get('/detail-{id}.html', 'PostsController@showDetail');

});
// posts
Route::group(['prefix' => 'admins'], function (){
    Route::get('/dashboard', 'Admins\DashboardController@index');
    Route::get('/posts', 'Admins\PostController@index');
    Route::get('/posts/add', 'Admins\PostController@add');
    Route::get('/posts/edit/{id}', 'Admins\PostController@edit');
    Route::post('/posts/add', 'Admins\PostController@add');
    Route::post('/posts/edit/{id}', 'Admins\PostController@edit');

});