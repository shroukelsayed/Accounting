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

Route::get('/', function () {
    return view('welcome');
});


Route::resource("users","UserController");

Route::get('/home', "IndexController@index");

Route::get('/allocation', "IndexController@allocation");
Route::get('/custody-advances', "IndexController@custodyAdvances");
Route::get('/treasury', "IndexController@treasury");
Route::get('/accounting-tree', "IndexController@accountingTree");


Route::get('/receipts', "IndexController@receipts");
Route::post('/receipts', "IndexController@receipts")->name('store');



// Route::get('/users', function () {
//     return view('welcome');
// });
