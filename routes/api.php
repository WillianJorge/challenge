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

Route::post('users/register', 'UserController@store');
Route::post('users/login', 'UserController@login');


Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('users/logout', 'UserController@logout');

    Route::get('users/', 'UserController@search');
    Route::get('users/all', 'UserController@index');
    Route::get('users/show/{id}', 'UserController@show');

    Route::post('accounts/', 'AccountController@store');
    Route::get('accounts/', 'AccountController@index');

});








