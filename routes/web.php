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
Route::get('/home', 'FrontendController@index')->name('home');
Route::get('/portfolio', 'FrontendController@portfolio')->name('portfolio');
Route::get('/details/{id}', 'FrontendController@getPortfolioEntryById');
Route::get('/contact', 'FrontendController@getContactPage');


// ** Backend ** 
Route::group(['middleware' => 'auth'], function() {

    // ** Page Routes //
    Route::get('settings', 'AdminUserControlPanel@getSettingsPage')->name('settings');
    Route::get('setup', 'AdminUserControlPanel@getSetupPage');
    Route::get('setup-skills', 'AdminUserControlPanel@getSetupSkillsPage');
    Route::get('skills', 'AdminUserControlPanel@getSkillsPage');
    Route::get('work', 'AdminUserControlPanel@getWorkPage');
    Route::get('portfolio/edit/{id}','AdminUserControlPanel@getEditPortfolioPage');
    Route::get('portfolio/add', 'PortfolioController@getAddPortfolioEntry');
});