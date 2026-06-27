<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\ForgotPasswordController;
use Modules\Auth\Http\Controllers\Api\AuthController;

Route::post('/login',[AuthController::class,'login']);
    Route::post('/verify-otp',[AuthController::class,'verifyOtp']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/profile',[AuthController::class,'profile']);
        Route::post('/logout',[AuthController::class,'logout']);
    });

    Route::middleware([
        'auth:sanctum',
        'role:super_admin'
    ])->group(function () {

        Route::get('/super-admin-dashboard',
            function(){
                return response()->json([
                    'message'=>'Welcome Super Admin'
                ]);
            });
    });

    Route::middleware([
        'auth:sanctum',
        'role:admin'
    ])->group(function () {

        Route::get('/admin-dashboard',
            function(){
                return response()->json([
                    'message'=>'Welcome Admin'
                ]);
            });
    });

    Route::middleware([
        'auth:sanctum',
        'role:cashier'
    ])->group(function () {

        Route::get('/cashier-dashboard',
            function(){
                return response()->json([
                    'message'=>'Welcome Cashier'
                ]);
            });
    });
     Route::middleware([
        'auth:sanctum',
        'role:waiter'
    ])->group(function () {

        Route::get('/waiter-dashboard',
            function(){
                return response()->json([
                    'message'=>'Welcome Waiter'
                ]);
            });
    });
     Route::middleware([
        'auth:sanctum',
        'role:cooker'
    ])->group(function () {

        Route::get('/cooker-dashboard',
            function(){
                return response()->json([
                    'message'=>'Welcome Cooker'
                ]);
            });
    });


Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

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
