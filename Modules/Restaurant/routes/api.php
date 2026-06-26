<?php

use Illuminate\Support\Facades\Route;
use Modules\Restaurant\Http\Controllers\RestaurantTableController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('restaurant-tables', RestaurantTableController::class)->names('restaurant-table');
});

Route::get('/RestaurantTable', [RestaurantTableController::class, 'index']);
Route::get('/RestaurantTable/{id}', [RestaurantTableController::class, 'show']);
Route::put('/RestaurantTable/{id}', [RestaurantTableController::class, 'update']);
Route::delete('/RestaurantTable/{id}' , [RestaurantTableController::class, 'destroy']);
Route::post('/RestaurantTable' , [RestaurantTableController::class, 'store']);