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
Route::get('category/{category}', 'ProductController@category')->name('category.show');

// Cart
Route::post('cart/{product}', 'CartController@add')->name('cart.add');
Route::get('cart', 'CartController@show')->name('cart.show');
Route::delete('cart/{product}', 'CartController@remove')->name('cart.remove');

// Orders
Route::get('purchase/address', 'PurchaseController@addressCreate')->name('purchase.address.create');
Route::post('purchase/address', 'PurchaseController@addressStore')->name('purchase.address.store');
Route::get('purchase/success', 'PurchaseController@success')->name('purchase.success');
Route::get('purchase/error', 'PurchaseController@error')->name('purchase.error');
Route::resource('purchase', 'PurchaseController')->only(['store', 'create']);
