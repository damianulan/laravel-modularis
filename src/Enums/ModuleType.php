<?php

namespace Modularis\Enums;

use Modularis\Contracts\ModuleTypeContract;

enum ModuleType: string implements ModuleTypeContract
{
    case MODULE = 'module';
    case LIBRARY = 'library';

    public function label(): string
    {
        return $this->value;
    }
}
