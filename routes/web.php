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

Route::get('/', 'FrontpageController@index')->name('frontpage');
Route::get('/microblog', 'MicroblogController@index')->name('microblog');
Route::post('/microblog/create', 'MicroblogController@create_post')->middleware('auth')->name('microblog_create_post');
Route::get('/microblog/load_new/{start_id}', 'MicroblogController@load_new')->name('load_new_posts');
Route::get('/microblog/load_older/{start_id}', 'MicroblogController@load_older')->name('load_older_posts');
Route::get('/microblog/init/{limit}', 'MicroblogController@init')->name('microblog_init');
Auth::routes();
