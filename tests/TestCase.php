<?php

namespace Cymatica\Hasher\Tests;

use Cymatica\Hasher\HasherServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var Application
     */
    protected $app;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app = $this->createApplication();
    }

    protected function getPackageProviders($app)
    {
        return [
            HasherServiceProvider::class,
        ];
    }
}
