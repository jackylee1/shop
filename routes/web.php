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

Route::get('/category/all', "CategoryController@getCategories")->name('category.all');
Route::get('/category/{id}', "CategoryController@getCategory")
                        ->name('category.info')->where('id', '[0-9]+');

Route::get('/category/create', "CategoryController@createCategory")->name('category.create');

Route::prefix('json')->group(function () {
    Route::get('/category/all', "CategoryController@getCategoriesJson")->name('category.all.json');
    Route::get('/category/{id}', "CategoryController@getCategoryJson")
                        ->name('category.info.json')->where('id', '[0-9]+');
});