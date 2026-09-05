<?php

namespace Modularis\Repositories;

use Illuminate\Filesystem\Filesystem;
use Modularis\Data\ComposerData;
use Modularis\Data\ManifestData;
use Modularis\Support\Transformers\FileDataTransformer;
use Modularis\Module;

class FilesRepository
{
    /** @var array<string, Module> */
    protected array $modules = [];

    public function __construct(
        protected Filesystem $filesystem,
    ) {
        $this->modules = $this->loadModules($this->filesystem->directories(modules_path()));
    }

    private function loadModules(array $paths): array
    {
        $modules = [];
        foreach ($paths as $path) {
            $composer = $this->getComposerJson($path);
            $manifest = $this->getManifestJson($path);
            $slug = $manifest['slug'];

            $modules[$slug] = [
                'composer' => $composer,
                'manifest' => $manifest,
            ];
        }

        return $modules;
    }
    private function getComposerData(string $path): ComposerData
    {
        return ComposerData::from(...$this->getComposerJson($path));
    }

        private function getManifestData(string $path): ManifestData
    {
        return ManifestData::from(...$this->getManifestJson($path));
    }

    private function getComposerJson(string $path): array
    {
        return json_decode($this->filesystem->get($path . '/composer.json'), true);
    }

    private function getManifestJson(string $path): array
    {
        return json_decode($this->filesystem->get($path . '/manifest.json'), true);
    }

    public function getModulesInfo(): array
    {
        return $this->modules;
    }
}
