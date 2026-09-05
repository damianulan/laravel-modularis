<?php

namespace Modularis;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Modularis\Commands\ClearCacheCommand;
use Modularis\Repositories\FilesRepository;
use Illuminate\Foundation\Application;

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
        $this->app->singleton('modules', fn(Application $app) => $app->make(ModuleRegistry::class));
    }

    public function boot(): void
    {
        $migrationPublishers = $this->migrationPublishers();

        $this->publishes([
            __DIR__ . '/../config/modularis.php' => config_path('modularis.php'),
        ], 'modularis-config');

        $this->publishes($migrationPublishers, 'modularis-migrations');

        $this->publishes(array_merge([
            __DIR__ . '/../config/modularis.php' => config_path('modularis.php'),
        ], $migrationPublishers), 'modularis');

        $this->registerCommands();
    }

    public function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ClearCacheCommand::class,
            ]);
        }
    }

    private function migrationPublishers(): array
    {
        return [
            __DIR__ . '/../database/migrations/create_modules_table.php.stub' => database_path('migrations/' . date('Y_m_d_His') . '_create_modules_table.php'),
        ];
    }
}
