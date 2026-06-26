<?php

use Illuminate\Support\Facades\Route;
use Modules\Stock\Http\Controllers\StockController;
use Modules\Stock\Http\Controllers\StockLogsController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('stocks', StockController::class)->names('stock');
    Route::apiResource('stock-logs', StockLogsController::class)->names('stock-log');
});

Route::get('/Stock', [StockController::class, 'index']);
Route::get('/Stock/{id}', [StockController::class, 'show']);
Route::put('/Stock/{id}', [StockController::class, 'update']);
Route::delete('/Stock/{id}' , [StockController::class, 'destroy']);
Route::post('/Stock' , [StockController::class, 'store']);

Route::get('/StockLogs', [StockLogsController::class, 'index']);
Route::get('/StockLogs/{id}', [StockLogsController::class, 'show']);
Route::put('/StockLogs/{id}', [StockLogsController::class, 'update']);
Route::delete('/StockLogs/{id}' , [StockLogsController::class, 'destroy']);
Route::post('/StockLogs' , [StockLogsController::class, 'store']);