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

Route::post('/signin', [\App\Http\Controllers\API\UserController::class, 'signin']);
Route::post('/signup', [\App\Http\Controllers\API\UserController::class, 'signup']);
Route::post('/googleLogin', [\App\Http\Controllers\API\UserController::class, 'googleLogin']);
Route::post('/forgotPass', [\App\Http\Controllers\API\UserController::class, 'forgotPass']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/fcmUpdate', [\App\Http\Controllers\API\UserController::class, 'fcmUpdate']);

});
