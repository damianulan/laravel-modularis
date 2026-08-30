<?php

namespace Modularis\Repositories;

use Illuminate\Filesystem\Filesystem;

class FilesRepository
{
    protected array $paths;

    protected array $modules;

    public function __construct(
        protected Filesystem $filesystem,
    ) {
        $this->paths = $this->filesystem->directories(modules_path());
        $this->modules = $this->loadModules();
    }

    private function loadModules(): array
    {
        $modules = [];
        foreach ($this->paths as $path) {
            $composer = $this->getComposerJson($path);
            $manifest = $this->getManifestJson($path);
            $alias = $manifest['alias'];
            $modules[$alias] = [
                'composer' => $composer,
                'manifest' => $manifest,
            ];
        }

        return $modules;
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
