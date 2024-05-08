<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout')->middleware('auth:api');
});

Route::middleware('auth:api')
    ->namespace('App\Http\Controllers\Api')
    ->prefix('bookings')
    ->group(function () {

        Route::get('/', 'BookingController@index');
        Route::post('/store', 'BookingController@store');
        Route::get('/show/{id}', 'BookingController@show');
        Route::patch('/update/{id}', 'BookingController@update');
        Route::delete('/destroy/{id}', 'BookingController@destroy');
    });

Route::middleware('auth:api')
    ->namespace('App\Http\Controllers\Api')
    ->prefix('hotels')
    ->group(function () {

        Route::get('/', 'HotelController@index');
        Route::get('/show/{id}', 'HotelController@show');
    });

Route::middleware('auth:api')
    ->namespace('App\Http\Controllers\Api')
    ->prefix('rooms')
    ->group(function () {

        Route::get('/', 'RoomController@index');
        Route::get('/show/{id}', 'RoomController@show');
    });


Route::middleware('auth:api')
    ->namespace('App\Http\Controllers\Api')
    ->prefix('settings')
    ->group(function () {

        Route::get('/', 'SettingController@index');
    });


Route::middleware('auth:api')
    ->namespace('App\Http\Controllers\Api')
    ->prefix('reviews')
    ->group(function () {

        Route::post('/store', 'ReviewController@store');
        Route::delete('/destroy/{id}', 'ReviewController@destroy');
    });
