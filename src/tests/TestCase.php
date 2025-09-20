<?php

namespace Dcplibrary\PAPIAccount\Tests;

use Dcplibrary\PAPIAccount\App\Providers\PAPIAccountServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

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
