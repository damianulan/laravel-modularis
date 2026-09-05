<?php

namespace Modularis\Data;

use Spatie\LaravelData\Data;

class ComposerData extends Data
{
    public function __construct(
        public string $name,
        public string $version = "1.0.0",
    ) {

    }
}
