<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\OrderItemsController;
use Modules\Order\Http\Controllers\OrderController;
use Modules\Order\Http\Controllers\OrderStatusLogsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('orders', OrderController::class)->names('order');
    Route::apiResource('order-items', OrderItemsController::class)->names('order-item');
    Route::apiResource('order-status-logs', OrderStatusLogsController::class)->names('order-status-log');
});


Route::get('/Order', [OrderController::class, 'index']);
Route::get('/Order/{id}', [OrderController::class, 'show']);
Route::put('/Order/{id}', [OrderController::class, 'update']);
Route::delete('/Order/{id}' , [OrderController::class, 'destroy']);
Route::post('/Order' , [OrderController::class, 'store']);

Route::get('/OrderItems', [OrderItemsController::class, 'index']);
Route::get('/OrderItems/{id}', [OrderItemsController::class, 'show']);
Route::put('/OrderItems/{id}', [OrderItemsController::class, 'update']);
Route::delete('/OrderItems/{id}' , [OrderItemsController::class, 'destroy']);
Route::post('/OrderItems' , [OrderItemsController::class, 'store']);

Route::get('/OrderStatusLogs', [OrderStatusLogsController::class, 'index']);
Route::get('/OrderStatusLogs/{id}', [OrderStatusLogsController::class, 'show']);
Route::put('/OrderStatusLogs/{id}', [OrderStatusLogsController::class, 'update']);
Route::delete('/OrderStatusLogs/{id}' , [OrderStatusLogsController::class, 'destroy']);
Route::post('/OrderStatusLogs' , [OrderStatusLogsController::class, 'store']);
