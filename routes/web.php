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
Route::get('/contacts/request', 'ContactRequestController@index')->name('contact.request');
Route::get('/contacts/{id}', 'ContactController@show')->name('contact.detail');
Route::post('/contacts/request/search', 'ContactRequestController@show')->name('contact.request.search');
Route::get('/contacts/request/send/{id}', 'contactRequestController@store')->name('contact.request.send');
Route::get('/contacts/request/recv', 'ContactReceivedRequestController@show')->name('contact.request.recv');
Route::post('/contacts/request/update', 'ContactRequestController@update')->name('contact.request.update');

Route::get('/message/{id}', 'MessageController@show')->name('message');
Route::get('/message', 'MessageListController@index')->name('message.list');
Route::post('/message/new', 'MessageListController@create')->name('message.new');
