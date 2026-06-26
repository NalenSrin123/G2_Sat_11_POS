<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class)->names('category');
});

Route::get('/Category', [CategoryController::class, 'index']);
Route::get('/Category/{id}', [CategoryController::class, 'show']);
Route::put('/Category/{id}', [CategoryController::class, 'update']);
Route::delete('/Category/{id}' , [CategoryController::class, 'destroy']);
Route::post('/Category' , [CategoryController::class, 'store']);