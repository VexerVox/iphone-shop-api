<?php

use Illuminate\Support\Facades\Route;

// Healthcheck
Route::get('/', function () {
    return response()->json(['success' => true]);
});

// Route::prefix('auth')->group(base_path('routes/api/auth.php'));
