<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\WebController::class,'index'])->name('/');
Route::get('/aboutus', [\App\Http\Controllers\WebController::class,'aboutus'])->name('aboutus');
Route::get('/contactus', [\App\Http\Controllers\WebController::class,'contactus'])->name('contactus');
Route::get('/terms', [\App\Http\Controllers\WebController::class,'terms'])->name('terms');
Route::get('/privacy', [\App\Http\Controllers\WebController::class,'privacy'])->name('privacy');

Auth::routes([
    'login' => true,
    'register' => true,
    'reset' => true,
    'verify' => false,
]);
Route::get('/two-factor-challenge',[\App\Http\Controllers\Auth\LoginController::class,'twoFactorChallenge'])->name('two-factor-challenge');
Route::post('/login/2fa',[\App\Http\Controllers\Auth\LoginController::class,'attempt2fa'])->name('login.2fa');

Route::group(['middleware' => ['disableMoveBack', 'auth']], function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'home'])->name('home');
    Route::get('/profile', [\App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
});

Route::get('/logout', [\App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
