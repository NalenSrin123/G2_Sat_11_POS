<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ProductVisibilityController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('products', ProductController::class)->names('product');
    Route::apiResource('product-visibilities', ProductVisibilityController::class)->names('product-visibility');
    Route::apiResource('categories', CategoryController::class)->names('category');
});

Route::get('/Product', [ProductController::class, 'index']);
Route::get('/Product/{id}', [ProductController::class, 'show']);
Route::put('/Product/{id}', [ProductController::class, 'update']);
Route::delete('/Product/{id}' , [ProductController::class, 'destroy']);
Route::post('/Product' , [ProductController::class, 'store']);

Route::get('/ProductVisibility', [ProductVisibilityController::class, 'index']);
Route::get('/ProductVisibility/{id}', [ProductVisibilityController::class, 'show']);
Route::put('/ProductVisibility/{id}', [ProductVisibilityController::class, 'update']);
Route::delete('/ProductVisibility/{id}' , [ProductVisibilityController::class, 'destroy']);
Route::post('/ProductVisibility' , [ProductVisibilityController::class, 'store']);
Route::post('/ProductVisibility' , [ProductVisibilityController::class, 'store']);
