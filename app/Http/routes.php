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
		Route::resource("projects","ProjectController");
		Route::resource("accounting-tree","AccountingTreeController");
		Route::post("add-child","AccountingTreeController@addChild");

		Route::get("add-expenses-item","AccountingTreeController@expensesItem");
		Route::post("add-expenses-item","AccountingTreeController@addExpensesItem");
		Route::get("add-fawry-item","AccountingTreeController@fawryItem");
		Route::post("add-fawry-item","AccountingTreeController@addFawryItem");
		Route::get("add-fawry-bank","AccountingTreeController@fawryBank");
		Route::post("add-fawry-bank","AccountingTreeController@addFawryBank");
		Route::get("add-bank-account-item","AccountingTreeController@bankAccountItem");
		Route::post("add-bank-account-item","AccountingTreeController@addBankAccountItem");
		Route::get("add-worker","AccountingTreeController@worker");
		Route::post("add-worker","AccountingTreeController@addWorker");
		Route::get("add-revenue-item","AccountingTreeController@revenueItem");
		Route::post("add-revenue-item","AccountingTreeController@addRevenueItem");
		Route::get("add-insurance-item","AccountingTreeController@insuranceItem");
		Route::post("add-insurance-item","AccountingTreeController@addInsuranceItem");

	});


	Route::group(['middleware' => ['auth']], function () {

		Route::get('/allocation', "IndexController@allocation");
		Route::get('/custody-advances', "IndexController@custodyAdvances");
		Route::get('/treasury', "IndexController@treasury");
		// Route::get('/accounting-tree', "IndexController@accountingTree");


		Route::get('/license-receipts/{id?}', "IndexController@licenseReceipts");
		Route::get('/receipts/{id?}', "IndexController@receipts");
		// Route::post('/save-receipt', "IndexController@saveReceipt");
		Route::post('/save-receipt/{id?}', "IndexController@saveReceipt");

		Route::post('/save-cash', "IndexController@saveCash");
		Route::post('/cash-receipt', "IndexController@cashReceipt");
		Route::get('/cash-receipt', "IndexController@cashReceipt");
		Route::get('/all-receipts', "IndexController@index");
		Route::get('/all-cash', "IndexController@allCashReceipts");
		Route::post('/receipts/search','IndexController@search');
		Route::post('/convert-number','IndexController@convertNumber');


	});



});










