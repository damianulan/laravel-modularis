<?php

namespace Modularis\Data;

use Spatie\LaravelData\Data;
use Modularis\Enums\ModuleType;

class ManifestData extends Data
{
    public function __construct(
        public string $name,
        public string $slug,
        public ModuleType $type,
        public int $priority = 0,
        public string $provider,
        public ?string $description = null,
    ) {}
}
