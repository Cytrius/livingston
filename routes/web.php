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

Auth::routes();

Route::get('/', 'HomeController@leadForm');

Route::get('/dashboard', 'HomeController@index');
Route::get('/dashboard/{a?}/{b?}/{c?}/{d?}/{e?}', 'HomeController@index');

Route::post('/quote', 'HomeController@quote');