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
// 	return view('dashboard');
// });

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'DashboardController@index')->name('dashboard');
	// Route::resource('user', 'UserController');
	Route::get('user/', 'UserController@index')->name('user');
	Route::post('user-all', 'UserController@getAll');
	Route::delete('user/{id}', 'UserController@destroy');
	Route::get('user/{id}/edit', 'UserController@edit')->name('user');
	Route::put('user/{id}', 'UserController@update');
	Route::post('user/create', 'UserController@create');
	Route::post('user-active', 'UserController@active');

	//Leasr Officer
	Route::get('lease_officer/', 'LeaseOfficerController@index')->name('lease_officer');
	Route::post('lease_officer-all', 'LeaseOfficerController@getAll');
	Route::post('lease_officer/create', 'LeaseOfficerController@create');

	//Leasr Company
	Route::get('lease_company/', 'LeaseCompanyController@index')->name('lease_company');
	Route::post('company-all', 'LeaseCompanyController@getAll');
	Route::delete('lease_company/{id}', 'LeaseCompanyController@destroy');
	Route::put('lease_company/{id}', 'LeaseCompanyController@update')->name('lease_company');
	Route::get('lease_company/{id}/edit', 'LeaseCompanyController@edit')->name('lease_company');
	Route::post('lease_company/create', 'LeaseCompanyController@create');
});