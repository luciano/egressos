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
    
    Route::get('/opportunities', 'AdminController@menuOpportunities')->name('admin.menu.opportunities');

    // news routes
    Route::resource('news', 'NewsController')->only(['create', 'edit', 'store', 'update', 'destroy'])->names([
        'create' => 'admin.news.create',
        'edit' => 'admin.news.edit',
        'store' => 'admin.news.store',
        'update' => 'admin.news.update',
        'destroy' => 'admin.news.destroy'
    ]);
    Route::get('/news', 'NewsController@indexAdmin')->name('admin.news.index');
    Route::get('/news/{id}', 'NewsController@showAdmin')->name('admin.news.show');

    // opportunities routes
    Route::resource('opportunities', 'OpportunitiesController')->only(['create', 'edit', 'store', 'update', 'destroy'])->names([
        'create' => 'admin.opportunities.create',
        'edit' => 'admin.opportunities.edit',
        'store' => 'admin.opportunities.store',
        'update' => 'admin.opportunities.update',
        'destroy' => 'admin.opportunities.destroy'
    ]);
    Route::get('/opportunities', 'OpportunitiesController@indexAdmin')->name('admin.opportunities.index');
    Route::get('/opportunities/{id}', 'OpportunitiesController@showAdmin')->name('admin.opportunities.show');

});

Route::resource('news', 'NewsController')->only(['index', 'show'])->names([
    'index' => 'user.news.index',
    'show' => 'user.news.show'
]);

Route::resource('opportunities', 'OpportunitiesController')->only(['index', 'show'])->names([
    'index' => 'user.opportunities.index',
    'show' => 'user.opportunities.show'
]);