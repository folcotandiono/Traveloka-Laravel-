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
Route::get('/findticket/{from}/{to}/{dateFlight}/{banyakOrang}', 'UserController@showFindTicket');
Route::get('/findticket/filterJadwal', 'UserController@filterJadwal');
Route::get('/prebooking/{noPenerbangan}/{banyakPenumpang}', 'UserController@prebooking');
