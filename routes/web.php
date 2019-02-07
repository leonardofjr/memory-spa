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
Route::get('/about', 'FrontendController@getAboutPage')->name('about');
Route::get('/skills', 'FrontendController@getSkillsPage')->name('skills');
Route::get('/details/{id}', 'FrontendController@getPortfolioEntryById');
Route::get('/contact', 'FrontendController@getContactPage');


// ** Backend ** 
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {

    // ** Page Routes //
    Route::get('settings', 'AdminUserControlPanel@getSettingsPage')->name('User Settings');
    Route::get('setup', 'AdminUserControlPanel@getSetupPage')->name('Setup');
    Route::get('setup-skills', 'AdminUserControlPanel@getSetupSkillsPage')->name('Setup Skills');
    Route::get('skills', 'AdminUserControlPanel@getSkillsPage')->name('Edit Skills');
    Route::get('work', 'AdminUserControlPanel@getWorkPage')->name('Portfolio Entries');
    Route::get('portfolio/edit/{id}','AdminUserControlPanel@getEditPortfolioPage')->name('Edit Portfolio Entry');
    Route::get('portfolio/add', 'PortfolioController@getAddPortfolioEntry')->name('Add Portfolio Entry');
});