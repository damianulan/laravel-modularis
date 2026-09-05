<?php

namespace Modularis\Repositories;

use Modularis\Models\ModuleModel;
use Modularis\Module;

class ModulesDatabaseRepository
{
    public function __construct(

    ) {

    }

    public function getOrCreate(Module $module): ModuleModel
    {
        return ModuleModel::firstOrCreate(
            ['slug' => $module->getSlug()],
            [
                'name' => $module->getName(),
                'type' => $module->getType(),
                'description' => $module->getDescription(),
                'version' => $module->getVersion()
            ]
        );
    }

    public function get(string $slug): ?ModuleModel
    {
        return ModuleModel::where('slug', $slug)->first();
    }
}
