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

Route::get('/contacts', 'ContactController@index')->name('contact');
Route::get('/contacts/{id}', 'ContactController@show')->name('contact.detail');

Route::get('/contacts/request', 'ContactRequestController@index')->name('contact.request');
Route::post('/contacts/request/send', 'contactRequestController@store')->name('contact.request.send');
Route::get('/contacts/request/recv', 'ContactRequestController@show')->name('contact.request.recv');
Route::get('/contacts/request/update', 'ContactRequestController@update')->name('contact.request.update');
