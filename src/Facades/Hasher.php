<?php

namespace Cymatica\Hasher\Facades;

use Illuminate\Support\Facades\Facade;

class Hasher extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'hasher';
    }
}
