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

/*
Route::get('/dashboard', function () {
    return view('dashboard');
});*/

//Route::get('dashboard/client','ClientController@index')->name('cliente.index');
//Route::get('dashboard/client/create','ClientController@create')->name('cliente.create');


Route::get('/dashboard','ClientController@index')->name('dasboard.client.index');
Route::resource('/dashboard/client','ClientController');

Route::get('/dashboard','ProductController@index')->name('dasboard.product.index');
Route::resource('/dashboard/product','ProductController');

