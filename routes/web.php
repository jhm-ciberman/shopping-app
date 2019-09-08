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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('products', 'ProductController')->only(['index', 'show']);
Route::post('cart/{product}', 'CartController@add')->name('cart.add');


Route::get('admin', 'Admin\AdminController@dashboard')->name('home');
