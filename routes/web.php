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

/* Public Routes */
Route::get('/get-a-quote', 'HomeController@form');

/* Admin and API Routes */
Route::get('/dashboard', 'HomeController@index');
Route::get('/dashboard/{a?}/{b?}/{c?}/{d?}/{e?}', 'HomeController@index');
Route::get('/import', 'ImportController@import');
Route::get('/book/{quote_id}', 'HomeController@book');
Route::post('/book-confirm/{quote_id}', 'HomeController@bookConfirm');

Route::get('/history', 'HomeController@history');

Route::post('/quote', 'HomeController@quote');
Route::post('/import', 'ImportController@importPost');

Route::get('/api/rates', 'RatesController@getAllRates');
Route::post('/api/rates', 'RatesController@newRate');
Route::get('/api/rates/filtered', 'RatesController@getFilteredRates');
Route::get('/api/rates/filters', 'RatesController@getAllRatesFilters');
Route::get('/api/rates/{rate_id}', 'RatesController@getRate');
Route::post('/api/rates/{rate_id}', 'RatesController@saveRate');
Route::delete('/api/rates/{rate_id}', 'RatesController@deleteRate');

Route::get('/api/quotes/notify/{quote_id}', 'QuotesController@notifyQuote');
Route::get('/api/quotes/booked/{quote_id}', 'QuotesController@bookedQuote');

Route::get('/api/quotes', 'QuotesController@getAllQuotes');
Route::get('/api/quotes/filtered', 'QuotesController@getFilteredQuotes');
Route::get('/api/quotes/filters', 'QuotesController@getAllQuotesFilters');

Route::get('/api/quotes/export', 'QuotesController@exportQuotes');

Route::get('/api/quote/{id}', 'QuotesController@getQuoteById');

Route::get('/api/accounts', 'AccountsController@getAllAccounts');
Route::get('/api/accounts/filtered', 'AccountsController@getFilteredAccounts');
Route::get('/api/accounts/filters', 'AccountsController@getAllAccountsFilters');

Route::get('/api/accounts/{account_id}/users', 'AccountsController@getUsersByAccountId');
Route::get('/api/accounts/{account_id}', 'AccountsController@getAccount');
Route::post('/api/accounts', 'AccountsController@newAccount');
Route::post('/api/accounts/{account_id}', 'AccountsController@saveAccount');
Route::delete('/api/accounts/{account_id}', 'AccountsController@deleteAccount');

Route::get('/api/users/{user_id}', 'AccountsController@getUser');
Route::post('/api/accounts/{account_id}/users', 'AccountsController@newUser');
Route::post('/api/users/{user_id}', 'AccountsController@saveUser');
Route::delete('/api/users/{user_id}', 'AccountsController@deleteUser');

Route::get('/api/dropdowns/origin/city', 'DropdownController@getCities');
Route::get('/api/dropdowns/destination/city', 'DropdownController@getCities');

Route::get('/api/dropdowns/origin/province', 'DropdownController@getProvince');
Route::get('/api/dropdowns/destination/province', 'DropdownController@getProvince');

Route::get('/api/dropdowns/vehicle/years', 'DropdownController@getVehicleYears');
Route::get('/api/dropdowns/vehicle/makes', 'DropdownController@getVehicleMakes');
Route::get('/api/dropdowns/vehicle/models', 'DropdownController@getVehicleModels');

Route::get('/api/settings', 'AccountsController@getSettings');
Route::post('/api/settings', 'AccountsController@saveSettings');
