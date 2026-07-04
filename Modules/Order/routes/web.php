<?php

use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\OrderItemsController;
use Modules\Order\Http\Controllers\OrderController;
use Modules\Order\Http\Controllers\OrderStatusLogsController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('orders', OrderController::class)->names('order');
    Route::resource('order-items', OrderItemsController::class)->names('order-item');
    Route::resource('order-status-logs', OrderStatusLogsController::class)->names('order-status-log');
});
