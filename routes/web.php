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

// Route::get('/', function () {
//     return view('welcome');
// });

// Authentication
Auth::routes();

Route::get('/', 'PostsController@index')->name('index');
Route::get('/home', 'PostsController@index')->name('home');

// SiteMap (html)
Route::get('sitemap.html', 'SitemapController@showHtml');
// SiteMap (xml)
Route::get('sitemap.xml', 'SitemapController@showXml');

// posts
Route::group(['prefix' => 'posts'], function (){
    Route::get('/', 'PostsController@showList');
    Route::get('/category-{categoryName}', 'PostsController@getListByCategoryName');
    Route::get('/detail-{id}.html', 'PostsController@showDetail');

});

// admins
Route::group(['prefix' => 'admins'], function (){
    Route::get('/dashboard', 'Admins\DashboardController@index');
    Route::get('/posts', 'Admins\PostController@index')->name('admin-posts');
    Route::get('/posts/add', 'Admins\PostController@add');
    Route::get('/posts/edit/{id}', 'Admins\PostController@edit');
    Route::post('/posts/add', 'Admins\PostController@add');
    Route::post('/posts/edit/{id}', 'Admins\PostController@edit');

    Route::get('/categories', 'Admins\CategoryController@index')->name('admin-category');
    Route::match(['get', 'post'], '/categories/add', 'Admins\CategoryController@add');
    Route::match(['get', 'post'], '/categories/edit/{id}', 'Admins\CategoryController@edit');
    Route::get('/links', 'Admins\LinkController@index')->name('admin-links');
    Route::match(['get', 'post'], '/links/add', 'Admins\LinkController@add');
    Route::match(['get', 'post'], '/links/edit/{id}', 'Admins\LinkController@edit');

    Route::get('/users', 'Admins\UserController@index')->name('admin-users');
});