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

Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@search');
    Route::post('/create', 'UserController@store');
    Route::get('/all', 'UserController@index');
    Route::get('/show/{id}', 'UserController@show');
});


Route::prefix('accounts')->group(function () {
    Route::post('/', 'AccountController@store');
    Route::get('/', 'AccountController@index');
});








