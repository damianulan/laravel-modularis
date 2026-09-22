<?php

namespace Modularis;

use Modularis\Support\ModulesAggregator;

class ModuleRegistry
{
    protected ModulesCollection $modules;

    public function __construct(
        ModulesAggregator $aggregator,
    )
    {
        $this->modules = $aggregator->auto()->getModules();
    }

    public function all(): ModulesCollection
    {
        return $this->modules;
    }

    public function get(string $slug): ?Module
    {
        return $this->modules->filterBySlug($slug)->first();
    }
}
