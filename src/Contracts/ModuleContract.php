<?php

namespace Modularis\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Modularis\Enums\ModuleType;

interface ModuleContract extends Arrayable
{
    public function getSlug(): string;

    public function getType(): ModuleType;

    public function getName(): string;

    public function getDescription(): ?string;

    public function getVersion(): string;

    public function getProviderClass(): string;

    public function getActive(): bool;
}
