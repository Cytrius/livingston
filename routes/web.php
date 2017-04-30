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
Route::get('/import', 'HomeController@import');
Route::get('/book', 'HomeController@book');

Route::post('/quote', 'HomeController@quote');
Route::post('/import', 'HomeController@importPost');

Route::get('/api/rates', 'RatesController@getAllRates');
Route::get('/api/rates/filtered', 'RatesController@getFilteredRates');
Route::get('/api/rates/filters', 'RatesController@getAllRatesFilters');

Route::get('/api/quotes', 'QuotesController@getAllQuotes');
Route::get('/api/quotes/filtered', 'QuotesController@getFilteredQuotes');
Route::get('/api/quotes/filters', 'QuotesController@getAllQuotesFilters');


Route::get('/api/quote/{id}', 'QuotesController@getQuoteById');

Route::get('/api/accounts', 'AccountsController@getAllAccounts');
Route::get('/api/accounts/filtered', 'AccountsController@getFilteredAccounts');
Route::get('/api/accounts/filters', 'AccountsController@getAllAccountsFilters');

Route::get('/api/account/{id}', 'AccountsController@getUsersByAccountId');