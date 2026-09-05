<?php

namespace Modularis\Commands;

use Illuminate\Console\Command;
use Modularis\Repositories\ModulesCacheRepository;

class ClearCacheCommand extends Command
{
    protected $signature = 'modularis:cache-clear';

    protected $description = 'Clear the Modularis cache';

    public function handle(ModulesCacheRepository $modulesCache): int
    {
        $modulesCache->clear();

        $this->comment('Modularis cache cleared.');

        return self::SUCCESS;
    }
}
