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
    Route::post('post-portfolio-entry', 'AdminUserControlPanel@postPortfolioEntry');
    Route::put('update-portfolio-entry/{id}', 'AdminUserControlPanel@updatePortfolioEntry');
    Route::delete('delete-portfolio-entry/{id}', 'AdminUserControlPanel@deletePortfolioEntry');