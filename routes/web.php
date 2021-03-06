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
Route::resource('blog', 'BlogController');

Route::get('login', 'LoginController@loginForm')->name('login');
Route::post('login', 'LoginController@login')->name('login');

Route::post('logout', 'LoginController@logout')->name('logout');

// 激活用户
Route::get('confirmEmailToken/{token}', 'UserController@confirmEmailToken')->name('confirmEmailToken');

// 重置密码
Route::get('findPassword', 'PasswordController@findPasswordForm')->name('findPassword');
Route::post('findPassword', 'PasswordController@findPassword')->name('findPassword');

Route::get('resetPassword/{token}', 'PasswordController@resetPasswordForm')->name('resetPassword');
Route::post('resetPassword', 'PasswordController@resetPassword')->name('resetPasswordStore');

// 关注与取关
Route::get('follow/{user}', 'UserController@follow')->name('userFollow');

// 我的粉丝列表
Route::get('user/{user}/fans', 'FollowController@fans')->name('fans');

// 我关注的列表
Route::get('user/{user}/follows', 'FollowController@follows')->name('follows');