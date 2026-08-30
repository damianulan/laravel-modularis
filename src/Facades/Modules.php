<?php

namespace Modula;

use Illuminate\Support\Facades\Facade;

class Modules extends Facade
{
    /**
     * Get the registered name of the component.
     */
    public static function getFacadeAccessor(): string
    {
        return 'modules';
    }
}
