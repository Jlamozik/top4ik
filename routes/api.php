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

Route::get('/aha', 'MAGA@show');

Route::post('/signup', 'MAGA@signUp');
Route::post('/signin', 'MAGA@signIn');
Route::post('/rec', 'MAGA@password_recovery');
Route::post('/logout', 'MAGA@logout');






Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
