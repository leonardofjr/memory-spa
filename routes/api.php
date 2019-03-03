<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

    // **  Routes //
Route::get('get-portfolio-entries', 'PortfolioController@getPortfolioEntries');
Route::get('portfolio/{id}', 'PortfolioController@getPortfolioEntriesById');
Route::post('post-portfolio-entry', 'PortfolioController@postPortfolioEntry');
Route::put('update-portfolio-entry/{id}', 'PortfolioController@updatePortfolioEntry');
Route::delete('delete-portfolio-entry/{id}', 'PortfolioController@deletePortfolioEntry');
// **  Routes //
Route::put('update-setup-skills/{id}', 'UserSettingController@updateSkills');
// **  Routes //
Route::put('update-user-settings/{id}', 'UserSettingController@updateUserSettings');
Route::get('get-user-settings', 'UserSettingController@getUserSettings');
