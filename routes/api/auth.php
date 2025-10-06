<?php

use App\Domains\Auth\Http\Controllers\AuthController;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::post('forgot-password', [AuthController::class, 'forgotPassword'])
    ->middleware('throttle:forgot-password')
    ->name('forgot-password');

Route::post('change-password', [AuthController::class, 'changePassword'])
    ->middleware('auth:sanctum')
    ->name('change-password');
