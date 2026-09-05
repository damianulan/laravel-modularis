<?php

namespace Modularis\Data;

use Spatie\LaravelData\Data;
use Composer\InstalledVersions;

class ComposerData extends Data
{
    public function __construct(
        public string $name,
        ?string $version = null,
    ) {
        $this->version = $version ?? InstalledVersions::getPrettyVersion($this->name);
    }

    public string $version;
}
