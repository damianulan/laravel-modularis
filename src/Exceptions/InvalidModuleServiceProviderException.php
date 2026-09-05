<?php

namespace Modularis\Exceptions;

use InvalidArgumentException;
use Modularis\Support\Providers\ModuleServiceProvider;

final class InvalidModuleServiceProviderException extends InvalidArgumentException
{
    public static function forModule(string $slug): self
    {
        return new self("The service provider for module [{$slug}] must extend " . ModuleServiceProvider::class . '.');
    }
}
