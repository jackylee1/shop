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

