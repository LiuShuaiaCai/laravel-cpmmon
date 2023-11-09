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

// 用户登录注册
Route::post('/auth/register', ['App\Http\Controllers\AuthController', 'register']);
Route::post('/auth/login', ['App\Http\Controllers\AuthController', 'login']);
Route::get('/auth/info', ['App\Http\Controllers\AuthController', 'info'])->middleware('jwt.auth');
Route::group(['middleware' => ['jwt.auth', 'auth.can']], function() {
    Route::get('/auth/refresh', ['App\Http\Controllers\AuthController', 'refresh']);
    Route::get('/auth/logout', ['App\Http\Controllers\AuthController', 'logout']);
    Route::get('/auth/delete/{id}', ['App\Http\Controllers\AuthController', 'delete']);
});


//Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
//    return $request->user();
//});
