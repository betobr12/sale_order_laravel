<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/dashboard','ClientController@index')->name('dasboard.client.index');
Route::resource('/dashboard/client','ClientController');

Route::get('/dashboard','ProductController@index')->name('dasboard.product.index');
Route::resource('/dashboard/product','ProductController');

Route::get('/dashboard','SaleController@index')->name('dasboard.sale.index');
Route::resource('/dashboard/sale','SaleController');

Route::get('/dashboard','ItemController@index')->name('dasboard.item.index');
Route::resource('/dashboard/item','ItemController');

Route::get('/dashboard','DashboardController@index')->name('dashboard.index');
