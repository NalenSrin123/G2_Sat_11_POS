<?php

use Illuminate\Support\Facades\Route;
use Modules\Stock\Http\Controllers\StockController;
use Modules\Stock\Http\Controllers\StockLogsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('stocks', StockController::class)->names('stock');
    Route::resource('stock-logs', StockLogsController::class)->names('stock-log');
});
