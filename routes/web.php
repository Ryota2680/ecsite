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

Auth::routes();

// Route::get('/', 'ItemController@index');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ItemController@index')->name('index');
Route::get('item/detail/{id}', 'ItemController@detail')->name('item.detail');