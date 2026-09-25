<?php

namespace Modularis;

use DateTime;

class ProvidersLoader
{
    public static function load(): array
    {
        $modules = [];
        foreach (glob(modules_path() . '/*', GLOB_ONLYDIR) as $directory) {
            if ($directory === '.' || $directory === '..') {
                continue;
            }

            if (! is_dir($directory)) {
                continue;
            }

            $manifestPath = $directory . DIRECTORY_SEPARATOR . 'manifest.json';

            if (! is_file($manifestPath)) {
                continue;
            }

            $manifest = json_decode(
                file_get_contents($manifestPath),
                true
            );
            $priority = (int) data_get($manifest, 'priority', 0);
            $provider = data_get($manifest, 'provider', null);

            if ($provider) {
                $modules[] = [
                    'priority' => $priority,
                    'provider' => $provider,
                ];
            }
        }
        usort($modules, fn (array $a, array $b) => $b['priority'] <=> $a['priority']);

        return array_map(fn (array $module) => $module['provider'], $modules);
    }

}
