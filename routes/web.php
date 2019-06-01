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

Auth::routes(['verify' => true]);

Route::any('/', 'ProductsController@index')->name('home');

Route::get('product/{product}', 'ProductsController@show')->name('products.show');

Route::get('category/{category}', 'CategoriesController@show')->name('categories.show');

Route::get('bookmarks', 'BookmarksController@index')->name('bookmarks.index');
Route::post('bookmarks', 'BookmarksController@store')->name('categories.store');

Route::get('cart', 'CartController@index')->name('cart.index');
Route::post('cart', 'CartController@store')->name('cart.store');
Route::delete('cart/{key}', 'CartController@destroy')->name('cart.destroy');
Route::patch('cart/{key}/{type}', 'CartController@update')->name('cart.update');

Route::get('order', 'OrderController@index')->name('order.index');

//Route::resource('products', 'ProductsController');
//Route::resource('categories', 'CategoriesController');
//Route::resource('bookmarks', 'BookmarksController');
