<?php

use App\Http\Controllers\UserController;
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


Route::post('users/signup', 'UserController@signup');

Route::post('users/signin', 'UserController@signin');

Route::middleware('auth:api')->group(function () {
    Route::get('/users', 'UserController@all_users');
    Route::resource('shopping', 'ShoppingController');
});