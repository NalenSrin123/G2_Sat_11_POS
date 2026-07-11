<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Api\AuthController;
use Modules\Auth\Http\Controllers\Api\ForgotPasswordController;
use Modules\Category\Http\Controllers\CategoryController;
use Modules\Customers\Http\Controllers\Api\CustomersController;
use Modules\Dashboard\Http\Controllers\DashboardController;
use Modules\Discount\Http\Controllers\DiscountController;
use Modules\Employee\Http\Controllers\EmployeeController;
use Modules\Kitchen\Http\Controllers\KitchenController;
use Modules\Order\Http\Controllers\OrderController;
use Modules\Order\Http\Controllers\OrderItemsController;
use Modules\Order\Http\Controllers\OrderStatusLogsController;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Http\Controllers\ProductVisibilityController;
use Modules\Report\Http\Controllers\ReportController;
use Modules\Restaurant\Http\Controllers\RestaurantTableController;
use Modules\Role\Http\Controllers\RoleController;
use Modules\Stock\Http\Controllers\StockController;
use Modules\Stock\Http\Controllers\StockLogsController;
use Modules\User\Http\Controllers\UserController;
use Modules\Waiter\Http\Controllers\WaiterController;


    Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    // Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    // Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
    Route::post('/register', [UserController::class, 'store']);
    Route::apiResource('roles', RoleController::class)->names('role');


        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::get('/categories/{id}', [CategoryController::class, 'show']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

        Route::get('/customers', [CustomersController::class, 'index']);
        Route::post('/customers', [CustomersController::class, 'store']);
        Route::get('/customers/{id}', [CustomersController::class, 'show']);
        Route::put('/customers/{id}', [CustomersController::class, 'update']);
        Route::delete('/customers/{id}', [CustomersController::class, 'destroy']);

        Route::apiResource('products', ProductController::class)->names('product');
        Route::apiResource('product-visibilities', ProductVisibilityController::class)->names('product-visibility');
        // Route::apiResource('dashboards', DashboardController::class)->names('dashboard'); did not finished the controller, so I commented it out.
        Route::apiResource('discounts', DiscountController::class)->names('discount');
        Route::apiResource('reports', ReportController::class)->names('report');
        Route::apiResource('restaurant-tables', RestaurantTableController::class)->names('restaurant-table');
        Route::apiResource('stocks', StockController::class)->names('stock');
        Route::apiResource('stock-logs', StockLogsController::class)->names('stock-log');
        Route::apiResource('users', UserController::class)->names('user');
        // Route::apiResource('waiters', WaiterController::class)->names('waiter'); did not finished the controller, so I commented it out.
        Route::apiResource('orders', OrderController::class)->names('order');
        Route::apiResource('order-items', OrderItemsController::class)->names('order-item');
        Route::apiResource('order-status-logs', OrderStatusLogsController::class)->names('order-status-log');
        // Route::apiResource('kitchens', KitchenController::class)->names('kitchen');  I don't get this error, why there isn't fisnished for the controller. 

        Route::get('/employees', [EmployeeController::class, 'index']);
        Route::get('/employees/{id}', [EmployeeController::class, 'show']);
        Route::post('/employees', [EmployeeController::class, 'store']);
        Route::put('/employees/{id}', [EmployeeController::class, 'update']);
        Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
  

    Route::middleware(['auth:sanctum', 'role:super_admin'])->group(function () {
        Route::get('/super-admin-dashboard', function () {
            return response()->json(['message' => 'Welcome Super Admin']);
        });
        
    });

    Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
        Route::get('/admin-dashboard', function () {
            return response()->json(['message' => 'Welcome Admin']);
        });
    });

    Route::middleware(['auth:sanctum', 'role:cashier'])->group(function () {
        Route::get('/cashier-dashboard', function () {
            return response()->json(['message' => 'Welcome Cashier']);
        });
    });

    Route::middleware(['auth:sanctum', 'role:waiter'])->group(function () {
        Route::get('/waiter-dashboard', function () {
            return response()->json(['message' => 'Welcome Waiter']);
        });
    });

    Route::middleware(['auth:sanctum', 'role:cooker'])->group(function () {
        Route::get('/cooker-dashboard', function () {
            return response()->json(['message' => 'Welcome Cooker']);
        });
    });


// <?php

// use Illuminate\Support\Facades\Route;
// use Modules\Auth\Http\Controllers\Api\AuthController;
// use Modules\Auth\Http\Controllers\Api\ForgotPasswordController;
// use Modules\Category\Http\Controllers\CategoryController;
// use Modules\Customers\Http\Controllers\Api\CustomersController;
// use Modules\Dashboard\Http\Controllers\DashboardController;
// use Modules\Discount\Http\Controllers\DiscountController;
// use Modules\Employee\Http\Controllers\EmployeeController;
// use Modules\Kitchen\Http\Controllers\KitchenController;
// use Modules\Order\Http\Controllers\OrderController;
// use Modules\Order\Http\Controllers\OrderItemsController;
// use Modules\Order\Http\Controllers\OrderStatusLogsController;
// use Modules\Product\Http\Controllers\ProductController;
// use Modules\Product\Http\Controllers\ProductVisibilityController;
// use Modules\Report\Http\Controllers\ReportController;
// use Modules\Restaurant\Http\Controllers\RestaurantTableController;
// use Modules\Role\Http\Controllers\RoleController;
// use Modules\Stock\Http\Controllers\StockController;
// use Modules\Stock\Http\Controllers\StockLogsController;
// use Modules\User\Http\Controllers\UserController;
// use Modules\Waiter\Http\Controllers\WaiterController;

// /*
// |--------------------------------------------------------------------------
// | Public Routes
// |--------------------------------------------------------------------------
// */

// Route::post('/login', [AuthController::class, 'login']);
// Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
// Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
// Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);
// Route::post('/register', [UserController::class, 'store']);

// /*
// |--------------------------------------------------------------------------
// | Protected Routes
// |--------------------------------------------------------------------------
// */

// Route::middleware('auth:sanctum')->group(function () {

//     // Authentication
//     Route::get('/profile', [AuthController::class, 'profile']);
//     Route::post('/logout', [AuthController::class, 'logout']);

//     /*
//     |--------------------------------------------------------------------------
//     | Super Admin Only
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware('role:super_admin')->group(function () {

//         Route::apiResource('roles', RoleController::class)->names('role');
//         Route::apiResource('users', UserController::class)->names('user');
//         Route::apiResource('dashboards', DashboardController::class)->names('dashboard');
//         Route::apiResource('reports', ReportController::class)->names('report');

//         Route::get('/super-admin-dashboard', function () {
//             return response()->json([
//                 'message' => 'Welcome Super Admin'
//             ]);
//         });
//     });

//     /*
//     |--------------------------------------------------------------------------
//     | Super Admin + Admin
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware('role:super_admin|admin')->group(function () {

//         Route::apiResource('categories', CategoryController::class)->names('category');
//         Route::apiResource('products', ProductController::class)->names('product');
//         Route::apiResource('product-visibilities', ProductVisibilityController::class)->names('product-visibility');
//         Route::apiResource('discounts', DiscountController::class)->names('discount');
//         Route::apiResource('restaurant-tables', RestaurantTableController::class)->names('restaurant-table');
//         Route::apiResource('stocks', StockController::class)->names('stock');
//         Route::apiResource('stock-logs', StockLogsController::class)->names('stock-log');

//         Route::get('/employee', [EmployeeController::class, 'index']);
//         Route::get('/employee/{id}', [EmployeeController::class, 'show']);
//         Route::post('/employee', [EmployeeController::class, 'store']);
//         Route::put('/employee/{id}', [EmployeeController::class, 'update']);
//         Route::delete('/employee/{id}', [EmployeeController::class, 'destroy']);

//         Route::get('/admin-dashboard', function () {
//             return response()->json([
//                 'message' => 'Welcome Admin'
//             ]);
//         });
//     });

//     /*
//     |--------------------------------------------------------------------------
//     | Super Admin + Admin + Cashier
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware('role:super_admin|admin|cashier')->group(function () {

//         Route::apiResource('customers', CustomersController::class)->names('customer');

//         Route::get('/cashier-dashboard', function () {
//             return response()->json([
//                 'message' => 'Welcome Cashier'
//             ]);
//         });
//     });

//     /*
//     |--------------------------------------------------------------------------
//     | Super Admin + Admin + Cashier + Waiter
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware('role:super_admin|admin|cashier|waiter')->group(function () {

//         Route::apiResource('orders', OrderController::class)->names('order');
//         Route::apiResource('order-items', OrderItemsController::class)->names('order-item');
//         Route::apiResource('waiters', WaiterController::class)->names('waiter');

//         Route::get('/waiter-dashboard', function () {
//             return response()->json([
//                 'message' => 'Welcome Waiter'
//             ]);
//         });
//     });

//     /*
//     |--------------------------------------------------------------------------
//     | Super Admin + Admin + Cooker
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware('role:super_admin|admin|cooker')->group(function () {

//         Route::apiResource('kitchens', KitchenController::class)->names('kitchen');
//         Route::apiResource('order-status-logs', OrderStatusLogsController::class)->names('order-status-log');

//         Route::get('/cooker-dashboard', function () {
//             return response()->json([
//                 'message' => 'Welcome Cooker'
//             ]);
//         });
//     });

// });

