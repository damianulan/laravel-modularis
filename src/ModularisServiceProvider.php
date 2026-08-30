<?php

namespace Modularis;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Modularis\Repositories\FilesRepository;

/**
 * @author Damian Ułan <damian.ulan@protonmail.com>
 * @copyright 2026 damianulan
 * @license MIT
 */
class ModularisServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/modularis.php', 'modularis');

        $this->app->singleton(FilesRepository::class, fn () => new FilesRepository(new Filesystem()));
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/modularis.php' => config_path('modularis.php'),
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
