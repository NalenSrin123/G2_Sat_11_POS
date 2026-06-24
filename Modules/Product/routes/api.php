<?php  
  
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\CategoriesController; // ← change
use Modules\Product\Http\Controllers\ProductController;  
  
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {  
    Route::apiResource('products', ProductController::class);  
    Route::apiResource('categories', CategoriesController::class); // ← change
});

// Route::get('/product', [ProductController::class, 'index']);
// Route::post('/product', [ProductController::class, 'store']);
// Route::get('/product/{id}', [ProductController::class, 'show']);
// Route::delete('/product/{id}', [ProductController::class, 'destroy']);
// Route::put('/product/{id}', [ProductController::class, 'update']);

// Route::get('/category', [CategoryController::class, 'index']);
// Route::post('/category', [CategoryController::class, 'store']);
// Route::get('/category/{id}', [CategoryController::class, 'show']);
// Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
// Route::put('/category/{id}', [CategoryController::class, 'update']);
