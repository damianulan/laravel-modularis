<?php

namespace Modularis\Repositories;

use Illuminate\Filesystem\Filesystem;
use Modularis\Data\ComposerData;
use Modularis\Data\ManifestData;
use Modularis\Support\Transformers\FileDataTransformer;

class FilesRepository
{
    public function __construct(
        protected Filesystem $filesystem,
        protected FileDataTransformer $transformer,
    ) {
        $this->loadModules($this->filesystem->directories(modules_path()));
    }

    /** @var array<string, array> */
    protected array $modules = [];

    private function loadModules(array $paths): void
    {
        $transformer = $this->transformer;
        foreach ($paths as $path) {
            $composer = $this->getComposerData($path);
            $manifest = $this->getManifestData($path);
            $slug = $manifest->slug;

            $this->modules[$slug] = $transformer($composer, $manifest);
        }
    }
    private function getComposerData(string $path): ComposerData
    {
        return ComposerData::from($this->getComposerJson($path));
    }

        private function getManifestData(string $path): ManifestData
    {
        return ManifestData::from($this->getManifestJson($path));
    }

    private function getComposerJson(string $path): array
    {
        return json_decode($this->filesystem->get($path . '/composer.json'), true, 512, JSON_OBJECT_AS_ARRAY);
    }

    private function getManifestJson(string $path): array
    {
        return json_decode($this->filesystem->get($path . '/manifest.json'), true, 512, JSON_OBJECT_AS_ARRAY);
    }

    /** @return array<string, array> */
    public function getModulesInfo(): array
    {
        return $this->modules;
    }
}
