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
/* Frontend */
Route::get('/home', 'FrontendController@getHomePage')->name('home');


// ** Backend ** 
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {

    // ** Page Routes //
    Route::get('settings', 'AdminUserControlPanel@getSettingsPage')->name('User Settings');
    Route::get('skills', 'AdminUserControlPanel@getSkillsPage')->name('Edit Skills');
    Route::get('portfolio', 'AdminUserControlPanel@getPortfolioPage')->name('Portfolio Entries');
    Route::get('portfolio/edit/{id}','AdminUserControlPanel@getEditPortfolioPage')->name('Edit Portfolio Entry');
    Route::get('portfolio/add', 'AdminUserControlPanel@getAddPortfolioEntryPage')->name('Add Portfolio Entry');
});