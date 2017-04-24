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

Route::get('/profiles', 'HomeController@index');
Route::get('/profiles/{a?}/{b?}/{c?}/{d?}/{e?}', 'HomeController@index');

Route::get('/api/profile/{id}', 'ProfileController@getProfile');
Route::get('/api/profiles', 'ProfileController@getProfiles');
Route::get('/api/profile/new', 'ProfileController@newProfile');
Route::post('/api/profile/new', 'ProfileController@newProfile');
Route::post('/api/profile', 'ProfileController@saveProfile');
Route::post('/api/profile/{id}', 'ProfileController@saveProfile');
Route::delete('/api/profile/{id}', 'ProfileController@deleteProfile');