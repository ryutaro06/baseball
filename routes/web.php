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

Route::group(['prefix' => 'admin'], function(){
    Route::get('baseball/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('baseball/create', 'Admin\NewsController@create')->middleware('auth');
    Route::get('baseball', 'Admin\NewsController@index')->middleware('auth');
    Route::get('baseball/edit', 'Admin\NewsController@edit')->middleware('auth');
    Route::post('baseball/edit', 'Admin\NewsController@update')->middleware('auth');
    Route::get('baseball/delete', 'Admin\NewsController@delete')->middleware('auth');
    
    Route::get('baseball/index', 'Admin\CommentController@comment_add')->middleware('auth');
    Route::post('baseball/indx', 'Admin\CommentController@comment_create')->middleware('auth');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
