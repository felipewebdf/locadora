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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('recover', 'AuthController@recover');
Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('company', 'Api\Company\CompanyController@index');
    Route::post('company', 'Api\Company\CompanyController@store');

    Route::post('car', 'Api\Car\CarController@store');
    Route::put('car/{tag}', 'Api\Car\CarController@update');
    Route::get('car/model', 'Api\Car\ModelController@index');


    Route::post('client', 'Api\Client\ClientController@store');
    Route::put('client/{id}', 'Api\Client\ClientController@update');
});
