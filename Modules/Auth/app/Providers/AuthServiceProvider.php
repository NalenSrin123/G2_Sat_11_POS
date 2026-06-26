<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Provider classes to register.
     *
     * @var string[]
     */
    protected array $providers = [
        EventServiceProvider::class,
        RouteServiceProvider::class,
    ];

    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadViewsFrom(module_path('Auth', 'resources/views'), 'auth');

        // Register migrations
        $this->loadMigrationsFrom(
            module_path('Auth', 'database/migrations')
        );
    }

    /**
     * Command classes to register.
     *
     * @var string[]
     */
    // protected array $commands = [];

    /**
     * Define module schedules.
     */
    // protected function configureSchedules(Schedule $schedule): void
    // {
    //     $schedule->command('inspire')->hourly();
    // }
}