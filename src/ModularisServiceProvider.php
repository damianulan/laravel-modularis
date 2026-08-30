<?php

namespace Modularis;

use Illuminate\Support\ServiceProvider;

/**
 * @author Damian Ułan <damian.ulan@protonmail.com>
 * @copyright 2026 damianulan
 * @license MIT
 */
class ModularisServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/modularis.php', 'modularis');
    }

    /**
     * When this method is apply we have all laravel providers and methods available
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/modularis.php' => config_path('modularis.php'),
        ], 'modularis-config');

        $this->publishes([
            __DIR__ . '/../config/lucent.php' => config_path('modularis.php'),
        ], 'modularis');

        $this->registerCommands();
    }

    public function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            //
        }
    }
}
