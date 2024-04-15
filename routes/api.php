<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\User\MeController;
use Illuminate\Support\Facades\Route;

Route::post('login', LoginController::class)->middleware('api');
Route::post('register', RegisterController::class);
Route::post('verify-email', VerifyEmailController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('me', [MeController::class, 'show']);
    Route::post('logout', LogoutController::class);
});