<?php

use App\Domains\Checkout\Http\Controllers\CheckoutController;

Route::post('', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('success/{order:uuid}', [CheckoutController::class, 'success'])->name('success');
