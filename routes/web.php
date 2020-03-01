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

Route::get('/login', 'LoginController@index');
Route::get('/', 'LoginController@index');
Route::post('/', 'LoginController@show')->name('login');

Route::post('/prof/update', 'ProfileController@update')->name('prof.update');
