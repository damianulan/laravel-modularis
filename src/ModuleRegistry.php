<?php

namespace Modularis;

use Modularis\Repositories\FilesRepository;
use Modularis\Repositories\ModulesCacheRepository;
use Modularis\Repositories\ModulesDatabaseRepository;

class ModuleRegistry
{
    protected ModulesCollection $modules;

    public function __construct(
        protected FilesRepository $filesRepository,
        protected ModulesDatabaseRepository $modulesDatabaseRepository,
        protected ModulesCacheRepository $modulesCacheRepository,
    )
    {
    }
}
