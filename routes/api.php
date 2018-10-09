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

header("Access-Control-Allow-Origin: *");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'apikey'], function(){
    Route::post('/login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'apikey'], function(){
    Route::apiResource('/users','UserController');
    Route::apiResource('/companies','CompanyController');
    Route::apiResource('/keywords','KeywordController');
});
