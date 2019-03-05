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



Route::get('/', 'PublicController@index')->name('index');
Route::get('singlePost/{id}', 'PublicController@singlePost')->name('singlePost');
Route::get('about', 'PublicController@about')->name('about');
Route::get('contact', 'PublicController@contact')->name('contact');



Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::prefix('user')->name('user.')->group(function (){

    Route::get('dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('comments', 'UserController@comments')->name('comments');

});

Route::prefix('author')->name('author.')->group(function (){

    Route::get('dashboard', 'AuthorController@dashboard')->name('dashboard');
    Route::get('posts', 'AuthorController@posts')->name('posts');
    Route::get('comments', 'AuthorController@comments')->name('comments');

});

Route::prefix('admin')->name('admin.')->group(function (){

    Route::get('dashboard','AdminController@dashboard')->name('dashboard');
    Route::get('posts', 'AdminController@posts')->name('posts');
    Route::get('comments', 'AdminController@comments')->name('comments');
    Route::get('users', 'AdminController@users')->name('users');

});
