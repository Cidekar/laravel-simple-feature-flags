<?php

namespace Cidekar\FeatureFlags\Tests;

use Cidekar\FeatureFlags\FeatureFlagsServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use function Orchestra\Testbench\artisan;

abstract class TestCase extends Orchestra
{

    protected function getPackageProviders($app)
    {
        return [
            FeatureFlagsServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function defineDatabaseMigrations()
    {
       $this->artisan('migrate', ['--database' => 'testbench'])->run(); 
    }
}