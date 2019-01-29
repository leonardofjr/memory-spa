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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/portfolio', 'HomeController@portfolio')->name('portfolio');
Route::get('/details/{id}', 'HomeController@getPortfolioEntryById');
// ** Admin** 
Route::group(['middleware' => 'auth'], function() {

    // ** Page Routes //
    Route::get('setup', 'AdminUserControlPanel@getSetupPage');
    Route::get('setup-skills', 'AdminUserControlPanel@getSetupSkillsPage');
    Route::get('skills', 'AdminUserControlPanel@getSkillsPage');
    Route::get('work', 'AdminUserControlPanel@getWorkPage');
    Route::get('portfolio/edit/{id}','AdminUserControlPanel@getEditPortfolioPage');
    Route::get('portfolio/add', 'PortfolioController@getAddPortfolioEntry');
});