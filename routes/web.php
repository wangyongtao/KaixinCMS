<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

// Route::get('/', function () {
//     return view('welcome');
// });

// Authentication
Auth::routes();

Route::get('/', 'ArticleController@index')->name('index');
Route::get('/home', 'ArticleController@index')->name('home');
Route::get('/a/{id?}', 'ArticleController@showDetail')->name('article_detail');
Route::get('/p/{id?}', 'ArticleController@showDetail')->name('post_detail');
Route::get('/popular', 'ArticleController@showPopularList')->name('popular');
Route::get('/popular', 'ArticleController@showPopularList')->name('popular');
Route::get('/category/{id?}', 'ArticleController@showCategory')->name('show_category');
Route::get('/tags/{id?}', 'ArticleController@showTag')->name('show_tags');

// 用户主页 users
Route::get('/user/{id}', 'UserController@show')->name('user_home');

// 友情链接 links
Route::get('/links', 'LinksController@show')->name('links');

// SiteMap (html)
Route::get('sitemap.html', 'SitemapController@showHtml');
// SiteMap (xml)
Route::get('sitemap.xml', 'SitemapController@showXml');
// 关于我们 about us
Route::group(['prefix' => 'about'], function () {
    Route::get('/about.html', 'About\AboutController@about');
    Route::get('/contact.html', 'About\AboutController@contact');
    Route::get('/disclaimer.html', 'About\AboutController@disclaimer');
    Route::get('/join.html', 'About\AboutController@join');
    Route::get('/jobs.html', 'About\AboutController@jobs');
    Route::get('/feedback.html', 'About\AboutController@feedback');
    Route::post('/feedback/add.html', 'About\AboutController@feedbackCreate');
});

Route::group(['prefix' => 'dict'], function () {
    Route::get('/', 'DictController@showList');
    Route::get('/roots.html', 'DictController@getList');
    Route::get('/detail-{id}.html', 'DictController@showDetail');
});

// 教程
Route::group(['prefix' => 'jiaocheng'], function () {
    Route::get('/list', 'Books\BookController@showList');
    Route::get('/show-{id}', 'Books\BookController@showDetail');
});

// admins
Route::group(['prefix' => 'admins'], function () {
//    Route::get('/dashboard', 'Admins\DashboardController@show');
    Route::get('/dashboard', 'Admins\DashboardController@show');

    // POST
    Route::get('/posts', 'Admins\ArticlesController@index')->name('admin-posts');
    Route::get('/posts/list', 'Admins\ArticlesController@index')->name('admin-posts-list');
    Route::get('/posts/add', 'Admins\ArticlesController@add');
    Route::get('/posts/edit/{id}', 'Admins\ArticlesController@edit');
    Route::post('/posts/add', 'Admins\ArticlesController@add');
    Route::post('/posts/edit/{id}', 'Admins\ArticlesController@edit');

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
    // feedback
    Route::get('/feedback', 'Admins\FeedbackController@index')->name('admin-feedback');

    // 图书教程
    Route::get('/books', 'Admins\BookController@index')->name('admin-books');
    Route::match(['get', 'post'], '/books/list', 'Admins\BookController@index');
    Route::match(['get', 'post'], '/books/add', 'Admins\BookController@add');
    Route::match(['get', 'post'], '/books/edit/{id}', 'Admins\BookController@edit');
    Route::match(['get', 'post'], '/books/section', 'Admins\BookController@sectionList');
    Route::match(['get', 'post'], '/books/section/add', 'Admins\BookController@sectionAdd');
    Route::match(['get', 'post'], '/books/section/edit/{id}', 'Admins\BookController@sectionEdit');

    // 待开发
    Route::get('/goods', 'Admins\UserController@index')->name('admin-goods');
    Route::get('/orders', 'Admins\UserController@index')->name('admin-orders');
    Route::get('/promotion', 'Admins\UserController@index')->name('admin-promotion');
    Route::get('/advisory', 'Admins\UserController@index')->name('admin-advisory');
    Route::post('/feedback/add', 'Admins\UserController@index');
});
