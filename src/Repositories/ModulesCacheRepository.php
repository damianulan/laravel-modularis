<?php

namespace Modularis\Repositories;

use Illuminate\Support\Facades\Cache;

class ModulesCacheRepository
{
    protected function getCacheDriver(): \Illuminate\Contracts\Cache\Repository
    {
        try {
            $cacheStore = config('modularis.cache.store');

            if ($cacheStore) {
                return Cache::store($cacheStore);
            }

            return Cache::store();
        } catch (\Exception $e) {
            return Cache::store(config('cache.default'));
        }
    }

    public function put(mixed $value): void
    {
        $this->getCacheDriver()->put(config('modularis.cache.prefix'), $value, config('modularis.cache.expire_after'));
    }

    public function clear(): bool
    {
        return $this->getCacheDriver()->forget(config('modularis.cache.prefix'));
    }
}
