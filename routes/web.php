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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('user.home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::post('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function() {
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');

    // password routes
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    // create user
    Route::get('/create/user', 'AdminController@createUser')->name('admin.create.user');

    // menu options
    Route::get('/users', 'AdminController@menuUsers')->name('admin.menu.users');
    Route::get('/graph', 'AdminController@menuGraph')->name('admin.menu.graph');
    Route::get('/events', 'AdminController@menuEvents')->name('admin.menu.events');
    Route::get('/news', 'AdminController@menuNews')->name('admin.menu.news');
    Route::get('/opportunities', 'AdminController@menuOpportunities')->name('admin.menu.opportunities');
});