<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('auths', AuthController::class)->names('auth');
});
Route::prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::get('/{id}', [AuthController::class, 'show']);
    Route::put('/{id}', [AuthController::class, 'update']);
    Route::delete('/{id}', [AuthController::class, 'destroy']);
});
