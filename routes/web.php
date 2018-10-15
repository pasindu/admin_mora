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
});