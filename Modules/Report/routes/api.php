<?php

use Illuminate\Support\Facades\Route;
use Modules\Report\Http\Controllers\ReportController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('reports', ReportController::class)->names('report');
});

Route::get('/report', [ReportController::class, 'index']);
Route::get('/report/{id}', [ReportController::class, 'show']);
Route::delete('/report/{id}', [ReportController::class, 'destory']);
Route::put('/report', [ReportController::class, 'update']);
Route::post('/report', [ReportController::class, 'store']);