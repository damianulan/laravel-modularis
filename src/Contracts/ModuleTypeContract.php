<?php

namespace Modularis\Contracts;

use BackedEnum;

interface ModuleTypeContract extends BackedEnum
{
    public function label(): string;
}
