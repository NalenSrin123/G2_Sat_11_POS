<?php

use Illuminate\Support\Facades\Route;

use Modules\Customers\Http\Controllers\Api\CustomersController;

Route::prefix('v1')->group(function () {
    Route::get('/customers', [CustomersController::class, 'index']);
    Route::post('/customers', [CustomersController::class, 'store']);
    Route::get('/customers/{id}', [CustomersController::class, 'show']);
    Route::put('/customers/{id}', [CustomersController::class, 'update']);
    Route::delete('/customers/{id}', [CustomersController::class, 'destroy']);
});