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

Route::get('/', 'UserController@index');
Route::get('/findticket', 'UserController@showFindTicket');
Route::get('/findticket/filterJadwal', 'UserController@filterJadwal');
Route::get('/prebooking', 'UserController@prebooking');
Route::get('/booking', 'UserController@booking');
Route::post('/booking/simpan', 'UserController@bookingSimpan');
Route::get('/payment', 'UserController@payment');
Route::get('/upload', 'UserController@upload');
Route::post('/finish', 'UserController@finish');
