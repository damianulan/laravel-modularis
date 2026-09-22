<?php

namespace Modularis;

use Illuminate\Support\Collection;
use Modularis\Contracts\ModuleContract;

class ModulesCollection extends Collection
{
    public function filterBySlug(string $slug): self
    {
        return $this->filter(fn (ModuleContract $module) => $module->getSlug() === $slug);
    }
}
