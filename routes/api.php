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


Route::post('login', 'Api\ApiController@login');
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', 'Api\ApiController@logout');
    Route::get('user', 'Api\ApiController@getAuthUser');
    Route::apiResource('apollo','Api\ApolloController');
    Route::apiResource('africa','Api\AfricaController');
    Route::apiResource('gaia','Api\GaiaController');
    Route::apiResource('seshat','Api\SeshatController');
    Route::apiResource('zalmo','Api\ZalmoController');
});
