<?php

namespace Modularis\Support;

use Modularis\Enums\ModuleType;
use Modularis\Exceptions\InvalidModuleServiceProviderException;
use Modularis\Module;
use Modularis\ModulesCollection;
use Modularis\Repositories\FilesRepository;
use Modularis\Repositories\ModulesCacheRepository;
use Modularis\Repositories\ModulesDatabaseRepository;
use Modularis\Support\Providers\ModuleServiceProvider;

class ModulesAggregator
{
    protected ModulesCollection $modules;

    public function __construct(
        protected FilesRepository $files,
        protected ModulesDatabaseRepository $db,
        protected ModulesCacheRepository $cache,
    ) {
        $this->modules = new ModulesCollection();
    }

    public function auto(): self
    {
        if ($this->cache->exists()) {
            $this->fromCache();
        } else {
            $this->fromLocal();
        }

        return $this;
    }

    public function fromCache(): self
    {
        $this->make($this->cache->get());

        return $this;
    }

    public function fromLocal(): self
    {
        $this->make(array_map(function (array $attributes): array {
            $model = $this->db->getOrCreate($attributes);
            $attributes['display_order'] = $model->getDisplayOrder();
            $attributes['db_version'] = $model->getVersion();
            $attributes['active'] = $model->isActive();
            return $attributes;
        }, $this->files->getModulesInfo()));

        return $this;
    }

    private function make(array $modules): void
    {
        foreach ($modules as $attributes) {
            $slug = $attributes['slug'];
            $name = $attributes['name'];
            $description = $attributes['description'];
            $type = $attributes['type'];

            if (is_string($name)) {
                $name = [config('app.locale') => $name];
            }

            if (is_string($description)) {
                $description = [config('app.locale') => $description];
            }

            if (is_string($type)) {
                $type = ModuleType::from($type);
            }

            if (
                !class_exists($attributes['provider'])
                || new \ReflectionClass($attributes['provider'])->isSubclassOf(ModuleServiceProvider::class)
            ) {
                throw new InvalidModuleServiceProviderException();
            }

            $this->modules->put($slug, new Module(
                $slug,
                $type,
                $name,
                $description,
                $attributes['priority'],
                $attributes['display_order'],
                $attributes['provider'],
                $attributes['version'],
                $attributes['db_version'] ?? null,
                $attributes['active'],
            ));
        }

        $this->remember();
    }

    private function remember(): void
    {
        if (config('modularis.cache.enabled')) {
            $this->cache->put($this->modules->toArray());
        }
    }

    public function getModules(): ModulesCollection
    {
        return $this->modules;
    }
}
