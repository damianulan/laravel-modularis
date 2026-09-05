<?php

namespace Modularis\Support\Transformers;

use Modularis\Data\ComposerData;
use Modularis\Data\ManifestData;
use Modularis\Module;

readonly class FileDataTransformer
{
    public function __construct(
        protected ComposerData $composerData,
        protected ManifestData $manifestData,
    ) {
    }
}
