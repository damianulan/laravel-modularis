<?php

namespace Modularis\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Modularis\Contracts\ModuleTypeContract;

interface ModuleContract extends Arrayable
{
    public function getSlug(): string;

    public function getType(): ModuleTypeContract;

    public function getName(): string;

    public function getAllNames(): array;

    public function getDescription(): ?string;

    public function getAllDescriptions(): array;

    public function getPriority(): int;

    public function getVersion(): string;

    public function isActive(): bool;

    public function all(): array;
}
