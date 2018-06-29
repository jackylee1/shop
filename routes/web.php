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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::redirect('/home', '/');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/user/login', "UserController@login")->name('user.login');
    Route::get('/user/register', "UserController@register")->name('user.register');
});

Route::prefix('category')->group(function() {
    Route::get('/all', "CategoryController@getCategories")->name('category.all');
    Route::get('/{id}', "CategoryController@getCategory")
        ->name('category.info')->where('id', '[0-9]+');

    Route::get('/create', "CategoryController@createCategory")->name('category.create');
});

Route::prefix('product')->group(function() {
    Route::get('/{id}', "ProductController@getProductInfo")
        ->name('product.info')->where('id', '[0-9]+');

    Route::get('/create', "ProductController@createProduct")->name('product.create');
});

Route::prefix('json')->group(function () {
    Route::get('/category/all', "CategoryController@getCategoriesJson")->name('category.all.json');
    Route::get('/category/{id}', "CategoryController@getCategoryJson")
                        ->name('category.info.json')->where('id', '[0-9]+');

    Route::get('/product/{id}', "ProductController@getProductInfoJson")
                        ->name('product.info.json')->where('id', '[0-9]+');
});