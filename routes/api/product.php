<?php

use App\Domains\Product\Http\Controllers\DeviceModelController;
use App\Domains\Product\Http\Controllers\ProductColorController;
use App\Domains\Product\Http\Controllers\ProductController;
use App\Domains\Product\Http\Controllers\ProductStorageCapacityController;

Route::get('/colors', [ProductColorController::class, 'index'])->name('colors');
Route::get('/storage-capacities', [ProductStorageCapacityController::class, 'index'])->name('storage-capacities');
Route::get('/device-models', [DeviceModelController::class, 'index'])->name('device-models');

Route::get('/', [ProductController::class, 'list'])->name('index');
Route::get('/{product:slug}', [ProductController::class, 'show'])->name('show');
