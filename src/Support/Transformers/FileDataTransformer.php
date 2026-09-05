<?php

namespace Modularis\Support\Transformers;

use Modularis\Data\ComposerData;
use Modularis\Data\ManifestData;

readonly class FileDataTransformer
{
    public function __invoke(
        ComposerData $composerData,
        ManifestData $manifestData,
    ): array {

        return [
            'slug' => $manifestData->slug,
            'type' => $manifestData->type,
            'name' => $manifestData->name,
            'description' => $manifestData->description,
            'priority' => $manifestData->priority,
            'provider' => $manifestData->provider,
            'version' => $composerData->version,
        ];
    }
}
