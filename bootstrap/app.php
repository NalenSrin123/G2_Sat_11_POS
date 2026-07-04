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
            foreach (glob(base_path('Modules/*/routes/api.php')) ?: [] as $routeFile) {
                Route::middleware('api')
                    ->prefix('api')
                    ->name('api.')
                    ->group($routeFile);
            }

            foreach (glob(base_path('Modules/*/routes/web.php')) ?: [] as $routeFile) {
                Route::middleware('web')
                    ->group($routeFile);
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
