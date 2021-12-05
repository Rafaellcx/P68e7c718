<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace ('App\Http\Controllers\Api')
    // ->middleware(['JwtAuthenticate'])
    ->prefix('user')->group(function () {
    Route::get('show/{id}', 'UserController@show');
    Route::post('store', 'UserController@store');
});

Route::namespace ('App\Http\Controllers\Api')
    ->prefix('mission')->group(function () {
    Route::get('show/{id}', 'MissionController@show');
    Route::post('store', 'MissionController@store');
    Route::delete('delete/{id}', 'MissionController@destroy');
});

Route::namespace ('App\Http\Controllers\Api')
    ->prefix('log-mission')->group(function () {
    Route::get('show/{id}', 'LogCommandMissionController@show');
    Route::get('commands-mission/{mission_id}', 'LogCommandMissionController@findCommandsByMission');
    Route::post('store', 'LogCommandMissionController@store');
});
