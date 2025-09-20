<?php

namespace Dcplibrary\PAPIAccount;

class PAPIAccount
{
    /**
     * Create a new PAPIAccount instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the package version.
     */
    public function version(): string
    {
        return '1.0.0';
    }

    /**
     * Get the package name.
     */
    public function name(): string
    {
        return 'PAPIAccount';
    }
}
