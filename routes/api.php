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

Route::get('/', function () {
    echo "api rodando";
});

Route::group(['middleware' => ['apiJwt', 'checkUser'], 'prefix' => 'auth',], function ($router) {

    //User
    Route::middleware(['checkUserPermission'])->group(function () {
        Route::post('user/{id}', 'V1\\UserController@update');
        Route::get('user/{id}', 'V1\\UserController@show');
    });

    //User Type
    Route::middleware(['blockRoute'])->group(function () {
        Route::post('user-type', 'V1\\UserTypeController@store');
        Route::post('user-type/{id}', 'V1\\UserTypeController@update');

        Route::get('user-type/{id}', 'V1\\UserTypeController@show');
        Route::get('user-type', 'V1\\UserTypeController@index');
    });

    //movie
    Route::post('movie', 'V1\\MoviesController@store');
    Route::post('movie/{id}', 'V1\\MoviesController@update');
    Route::get('movie', 'V1\\MoviesController@index');
    Route::get('movie/{id}', 'V1\\MoviesController@show');
    Route::delete('movie/{id}', 'V1\\MoviesController@destroy');

    //movie tag
    Route::post('movie-tag', 'V1\\MovieTagController@store');
    Route::post('movie-tag/{id}', 'V1\\MovieTagController@update');
    Route::get('movie-tag', 'V1\\MovieTagController@index');
    Route::get('movie-tag/{id}', 'V1\\MovieTagController@show');


    //tag
    Route::post('tag', 'V1\\TagController@store');
    Route::post('tag/{id}', 'V1\\TagController@update');
    Route::get('tag', 'V1\\TagController@index');
    Route::get('tag/{id}', 'V1\\TagController@show');
    Route::delete('tag/{id}', 'V1\\TagController@destroy');

    //admin
    Route::post('is-active-user/{userId}', 'V1\\AdminController@isActiveUser');

});

Route::group(['prefix' => ''], function ($router) {
    //User
    Route::post('user', 'V1\\UserController@store');
    Route::post('login', 'V1\\AuthController@login');
});
