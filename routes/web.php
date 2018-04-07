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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// IndexController
Route::get('/', 'IndexController@index');
Route::get('/send/{user_id}', 'IndexController@send');
Route::post('/post', 'IndexController@post');

// HistoryController
Route::get('/history_all', 'HistoryController@all');
Route::get('/history/{user_id}', 'HistoryController@user');
