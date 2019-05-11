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

Route::get('/', 'ShoppingCartController@index');
Route::get('/cart', 'ShoppingCartController@get');
Route::get('/products', 'ProductController@all');
Route::post('/cart/{cartId}/item', 'ShoppingCartController@addItem');
Route::delete('/cart/{cartId}/item/{itemId}', 'ShoppingCartController@removeItem');