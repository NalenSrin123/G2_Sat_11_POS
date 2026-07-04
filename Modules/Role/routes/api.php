<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\Http\Controllers\RoleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('roles', RoleController::class)->names('role');
});

Route::get('/role', [roleController::class, 'index']);
Route::get('/role/{id}', [roleController::class, 'show']);
Route::put('/role/{id}', [roleController::class, 'update']);
Route::delete('/role/{id}' , [roleController::class, 'destroy']);
Route::post('/role' , [roleController::class, 'store']);
