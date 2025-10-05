<?php

use App\Http\Controllers\Product\DeviceModelController;
use App\Http\Controllers\Product\ProductColorController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductStorageCapacityController;

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/{product:slug}', [ProductController::class, 'show'])->name('show');

Route::get('/colors', [ProductColorController::class, 'index'])->name('colors');
Route::get('/storage-capacities', [ProductStorageCapacityController::class, 'index'])->name('storage-capacities');
Route::get('/device-models', [DeviceModelController::class, 'index'])->name('device-models');
