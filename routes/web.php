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
Route::group(['prefix' => 'posts'], function (){
    Route::get('/', 'PostsController@showList');
    Route::get('/category/{$categoryName}', 'PostsController@showCategory');
    Route::get('/detail-{id}.html', 'PostsController@showDetail');

});