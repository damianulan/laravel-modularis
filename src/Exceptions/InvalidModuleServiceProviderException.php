<?php

namespace Modularis\Exceptions;

use Exception;
use Modularis\Support\Providers\ModuleServiceProvider;
use Throwable;

final class InvalidModuleServiceProviderException extends Exception
{
    public function __construct(string $slug, ?Throwable $previous = null)
    {
        parent::__construct(
            "The service provider for module [{$slug}] must extend " . ModuleServiceProvider::class . '.',
            0,
            $previous
        );
    }
}
