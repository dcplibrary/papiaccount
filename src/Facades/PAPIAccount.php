<?php

namespace Dcplibrary\PAPIAccount\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dcplibrary\PAPIAccount\PAPIAccount
 */
class PAPIAccount extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'PAPIAccount';
    }
}
