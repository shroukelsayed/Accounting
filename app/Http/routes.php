<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['web']], function () {
    Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

    Route::auth();
	Route::get('/','HomeController@index');
	Route::get('/home', function () {
	    return view('welcome');
	});
	Route::group(['middleware' => ['auth' ,'admin']], function () {
		Route::get('/admin', function () {
	    	return view('home');
		});
		Route::resource("users","UserController");

	});


	Route::group(['middleware' => ['auth']], function () {

		Route::get('/allocation', "IndexController@allocation");
		Route::get('/custody-advances', "IndexController@custodyAdvances");
		Route::get('/treasury', "IndexController@treasury");
		Route::get('/accounting-tree', "IndexController@accountingTree");


		Route::get('/receipts', "IndexController@receipts");
		Route::post('/receipts', "IndexController@receipts")->name('store');

		Route::get('/cash-receipt', "IndexController@cashReceipt");

	});



});










