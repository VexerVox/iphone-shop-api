<?php

use Illuminate\Support\Facades\Route;

Route::prefix('products')->as('products.')->group(base_path('routes/api/product.php'));
