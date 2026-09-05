<?php

namespace Modularis\Support;

use Modularis\Module;
use Modularis\Repositories\FilesRepository;
use Modularis\Repositories\ModulesCacheRepository;
use Modularis\Repositories\ModulesDatabaseRepository;

class ModulesAggregator
{
    protected array $modules = [];

    public function __construct(
        protected FilesRepository $files,
        protected ModulesDatabaseRepository $db,
        protected ModulesCacheRepository $cache,
    ) {}

    public function recreate(): void
    {
        foreach ($this->files->getModulesInfo() as $slug => $attributes) {
            $model = $this->db->get($slug);
            $active = $model->active ?? true;
            dd($model, $attributes);

            $this->modules[$slug] = new Module(
                $attributes['slug'],
                $attributes['type'],
                $attributes['name'],
                $attributes['description'],
                $attributes['priority'],
                $attributes['provider'],
                $attributes['version'],
                $model?->db_version,
                $active,
            );
        }
        dd($this->files->getModulesInfo());
    }

    public function remember(): void
    {

    }

}
