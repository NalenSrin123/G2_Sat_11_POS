<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route; // 💡 កែមកប្រើប្រាស់ Facade មួយនេះវិញ ទើបលែងលោត Error

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // អាន Route របស់ Module Customers
            if (file_exists(base_path('Modules/Customers/routes/api.php'))) {
                Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('Modules/Customers/routes/api.php'));
            }
            
            // អាន Route របស់ Module Auth
            if (file_exists(base_path('Modules/Auth/routes/api.php'))) {
                Route::middleware('api')
                    ->prefix('api')
                    ->group(base_path('Modules/Auth/routes/api.php'));
            }
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        // រួមបញ្ចូល Middleware ទាំងពីរចូលគ្នាកុំឱ្យជាន់គ្នា
        $middleware->alias([
            'role' => \Modules\Auth\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();