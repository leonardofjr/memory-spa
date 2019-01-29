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
    Route::post('post-portfolio-entry', 'PortfolioController@postPortfolioEntry');
    Route::put('update-portfolio-entry/{id}', 'PortfolioController@updatePortfolioEntry');
    Route::delete('delete-portfolio-entry/{id}', 'PortfolioController@deletePortfolioEntry');
    // **  Routes //
    Route::post('post-setup-skills', 'UserSettingController@createSkills');
    Route::put('update-setup-skills/{id}', 'UserSettingController@updateSkills');
    // **  Routes //
    Route::post('post-user-settings', 'UserSettingController@createUserSettings');
    Route::put('update-user-settings/{id}', 'UserSettingController@updateUserSettings');