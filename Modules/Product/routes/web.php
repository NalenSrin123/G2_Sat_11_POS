<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ProductVisibilityController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('products', ProductController::class)->names('product');
    Route::resource('product-visibilities', ProductVisibilityController::class)->names('product-visibility');
});
