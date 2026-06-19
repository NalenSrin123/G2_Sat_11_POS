<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register migrations
        $this->loadMigrationsFrom(module_path('Auth', 'database/migrations'));

        // Register views
        $this->loadViewsFrom(module_path('Auth', 'resources/views'), 'auth');
    }
}