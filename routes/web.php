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

// admins
Route::group(['prefix' => 'admins'], function (){
    Route::get('/dashboard', 'Admins\DashboardController@index');
    Route::get('/posts', 'Admins\PostsController@index')->name('admin-posts');
    Route::get('/posts/add', 'Admins\PostsController@add');
    Route::get('/posts/edit/{id}', 'Admins\PostsController@edit');
    Route::post('/posts/add', 'Admins\PostsController@add');
    Route::post('/posts/edit/{id}', 'Admins\PostsController@edit');

    Route::get('/categories', 'Admins\CategoryController@index')->name('admin-category');
    Route::match(['get', 'post'], '/categories/add', 'Admins\CategoryController@add');
    Route::match(['get', 'post'], '/categories/edit/{id}', 'Admins\CategoryController@edit');
    // links
    Route::get('/links', 'Admins\LinksController@index')->name('admin-links');
    Route::match(['get', 'post'], '/links/add', 'Admins\LinksController@add');
    Route::match(['get', 'post'], '/links/edit/{id}', 'Admins\LinksController@edit');
    // settings
    Route::get('/settings', 'Admins\SettingsController@index')->name('admin-settings');
    // users
    Route::get('/users', 'Admins\UsersController@index')->name('admin-users');

    // 待开发
    Route::get('/goods', 'Admins\UserController@index')->name('admin-goods');
    Route::get('/orders', 'Admins\UserController@index')->name('admin-orders');
    Route::get('/promotion', 'Admins\UserController@index')->name('admin-promotion');
    Route::get('/advisory', 'Admins\UserController@index')->name('admin-advisory');
    Route::get('/feedback', 'Admins\UserController@index')->name('admin-feedback');
    Route::post('/feedback/add', 'Admins\UserController@index');
});

// posts
Route::group(['prefix' => 'posts'], function (){
    Route::get('/', 'PostsController@showList');
    Route::get('/category-{categoryName}', 'PostsController@showList');
    Route::get('/detail-{id}.html', 'PostsController@showDetail');

});

Route::group(['prefix' => 'dict'], function (){
    Route::get('/', 'DictController@showList');
    Route::get('/roots.html', 'DictController@getList');
    Route::get('/detail-{id}.html', 'DictController@showDetail');

});

Route::get('website', 'WebsiteController@showList');
Route::get('website/diqu/{area}', 'WebsiteController@showListByArea');
Route::get('website/hangye/{industry}', 'WebsiteController@showListByIndustry');



// about us
Route::group(['prefix' => 'about'], function (){
    Route::get('/about.html', 'AboutController@about');
    Route::get('/contact.html', 'AboutController@contact');
    Route::get('/disclaimer.html', 'AboutController@disclaimer');
    Route::get('/join.html', 'AboutController@join');
    Route::get('/jobs.html', 'AboutController@jobs');
    Route::get('/feedback.html', 'AboutController@feedback');
    Route::post('/feedback/add.html', 'AboutController@feedbackCreate');
});

// helps
Route::group(['help' => 'help'], function (){

});
