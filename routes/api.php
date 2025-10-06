<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->as('auth.')->group(base_path('routes/api/auth.php'));
Route::prefix('products')->as('products.')->group(base_path('routes/api/product.php'));
Route::prefix('checkout')->as('checkout.')->group(base_path('routes/api/checkout.php'));
