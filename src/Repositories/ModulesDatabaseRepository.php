<?php

namespace Modularis\Repositories;

use Modularis\Contracts\ModuleModelContract;
use Modularis\Models\ModuleModel;
class ModulesDatabaseRepository
{
    public function __construct(

    ) {

    }

    public function getOrCreate(array $attributes): ModuleModelContract
    {
        return ModuleModel::firstOrCreate(
            ['slug' => $attributes['slug']],
            [
                'version' => $attributes['version'],
            ]
        );
    }

    public function get(string $slug): ?ModuleModelContract
    {
        return ModuleModel::where('slug', $slug)->first();
    }
}
