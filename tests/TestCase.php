<?php

namespace Tests;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        $this->ensureTestingEnvironment();

        parent::setUp();
    }

    private function ensureTestingEnvironment(): void
    {
        $envTestingPath = dirname(__DIR__).'/.env.testing';

        if (! file_exists($envTestingPath)) {
            $this->markTestSkipped('.env.testing file is required to run tests. Copy .env.example to .env.testing and configure a separate test database.');
        }
    }
}
