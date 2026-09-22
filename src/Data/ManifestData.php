<?php

namespace Modularis\Data;

use Spatie\LaravelData\Data;
use Modularis\Enums\ModuleType;

class ManifestData extends Data
{
    public function __construct(
        public string $slug,
        public array|string $name,
        public array|string|null $description,
        public ModuleType $type,
        public int $priority = 0,
        public string $provider,
    ) {}
}
