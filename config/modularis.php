<?php

return [

    'cache' => [
        'enabled' => env('MODULARIS_CACHE_ENABLED', true),
        'prefix' => 'modularis_cache',
        'store' => env('MODULARIS_CACHE_STORE', env('CACHE_DRIVER', 'file')),
        'expire_after' => 86400,
    ],
];
