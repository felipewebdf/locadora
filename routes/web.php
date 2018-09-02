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

Route::get('/', '\App\Http\Controllers\IndexController@index');

Route::get('user/verify/{verification_code}', 'AuthController@verifyUser');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@postReset')->name('password.reset');

Route::group(['prefix' => 'web'], function() {
    Route::get('/', '\App\Http\Controllers\Web\IndexController@index');
    Route::get('company', '\App\Http\Controllers\Web\CompanyController@index');

    Route::get('car', '\App\Http\Controllers\Web\CarController@index');
    Route::get('car/create', '\App\Http\Controllers\Web\CarController@create');
    Route::get('car/update/{tag}', '\App\Http\Controllers\Web\CarController@update');

    Route::get('client', '\App\Http\Controllers\Web\ClientController@index');
    Route::get('client/create', '\App\Http\Controllers\Web\ClientController@create');
    Route::get('client/update/{id}', '\App\Http\Controllers\Web\ClientController@update');

    Route::get('rent', '\App\Http\Controllers\Web\RentController@index');
    Route::get('rent/create', '\App\Http\Controllers\Web\RentController@create');
    Route::get('rent/update/{id}', '\App\Http\Controllers\Web\RentController@update');

    Route::get('rent/{rent_id}/inspection', '\App\Http\Controllers\Web\InspectionController@create');
    Route::get('rent/{rent_id}/inspection/{id}', '\App\Http\Controllers\Web\InspectionController@update');
});

