<?php

namespace Dcplibrary\PAPIAccount\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Dcplibrary\PAPIAccount\App\Providers\PAPIAccountServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }
    
    protected function getPackageProviders($app): array
    {
        return [
            PAPIAccountServiceProvider::class,
        ];
    }
}
