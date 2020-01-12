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
/* Frontend */

Route::get('/', 'FrontendController@getHomePage');
Auth::routes(['verify' => true]);

//Route::get('/{catchall?}', 'FrontendController@getHomePage')->where('catchall', '^(?!admin).*$', '^(?!api).*$', '^(?!email).*$')->name('administration');

// ** Backend ** 
// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('admin/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('admin/register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('admin/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
 Route::post('admin/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('admin/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('admin/password/reset', 'Auth\ResetPasswordController@reset');


Route::get('get-user-settings', 'UserSettingController@getUserSettings');
Route::put('update-user-settings/{id}', 'UserSettingController@updateUserSettings');


// ** Admin Root Routes //

Route::group(['middleware' => 'verified', 'prefix' => 'admin'], function() {
    Route::get('profile', 'Backend\UserControlPanelController@index')->name('Profile');
});

// ** Portfolio Routes //

Route::group(['middleware' => 'verified', 'prefix' => 'admin/portfolio'], function() {
    Route::get('/', 'Backend\PortfolioController@index')->name('Portfolio');
    Route::get('add', 'Backend\PortfolioController@create')->name('Add Portfolio Entry');
    Route::get('edit/{id}','Backend\PortfolioController@edit')->name('Edit Portfolio Entry');
});

// ** Blog Routes //
Route::group(['middleware' => 'verified', 'prefix' => 'admin/blog'], function() {
    Route::get('/', 'Backend\BlogController@index')->name('Blog');
    Route::get('add', 'Backend\BlogController@create')->name('Add Blog Post');
    Route::get('edit/{id}','Backend\BlogController@edit')->name('Edit Blog Entry');
});

Route::post('upload-cropped-image', 'HelperMethodsController@uploadCroppedImage');
Route::post('post-portfolio-entry', 'Backend\PortfolioController@store');
Route::put('update-portfolio-entry/{id}', 'Backend\PortfolioController@update');
Route::delete('delete-portfolio-entry/{id}', 'Backend\PortfolioController@destroy');

