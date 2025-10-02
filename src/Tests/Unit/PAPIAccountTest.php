<?php

namespace Dcplibrary\PAPIAccount\Tests\Unit;

use Dcplibrary\PAPIAccount\PAPIAccount;
use Dcplibrary\PAPIAccount\Tests\TestCase;

class PAPIAccountTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated(): void
    {
        $instance = new PAPIAccount();

        $this->assertInstanceOf(PAPIAccount::class, $instance);
    }

    /** @test */
    public function it_returns_correct_name(): void
    {
        $instance = new PAPIAccount();

        $this->assertEquals('PAPIAccount', $instance->name());
    }
}
