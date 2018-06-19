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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

	// Users
	Route::resource('users','UserController');
	Route::group(['before' => 'permission:user-change-status'], function()
	{
		Route::post('users/ajax', ['as' => 'users.ajax', 'uses' => 'UserController@ajaxAction']);
	});


    
    
    Route::resource('roles','RoleController');
	Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('/performance', 'PerformanceController');
	Route::resource('/fund', 'FundController');
});