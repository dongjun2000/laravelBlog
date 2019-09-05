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

Route::get('/', 'WelcomeController@home')->name('home');

Route::resource('user', 'UserController');

Route::get('login', 'LoginController@loginForm')->name('login');
Route::post('login', 'LoginController@login')->name('login');

Route::get('logout', 'LoginController@logout')->name('logout');

// 激活用户
Route::get('confirmEmailToken/{token}', 'UserController@confirmEmailToken')->name('confirmEmailToken');