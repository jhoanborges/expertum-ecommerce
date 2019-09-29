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


Route::get('/', 'WelcomeController@index')->name('home.index');


Route::get('/store', 'StoreController@index')->name('store.index');
Route::get('/product', 'ProductController@index')->name('product.index');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart.get', 'CartController@get')->name('cart.get');
Route::get('/contacto', 'ContactoController@index')->name('contacto.index');
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
