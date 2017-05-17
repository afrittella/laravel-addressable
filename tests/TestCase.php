<?php

namespace Tests;

//use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    //use CreatesApplication;

    public function setUp()
    {
        parent::setUp();

        $this->loadLaravelMigrations('testing');
        $this->loadMigrationsFrom([
           '--database' => 'testing'
        ]);
        $this->artisan('migrate', ['--database' => 'testing']);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver'   => 'mysql',
            'host' => env('TRAVIS_HOST', 'mariadb'),
            'database' => 'addressable_tests',
            'prefix'   => '',
            'username' => env('TRAVIS_USER', 'test'),
            'password' => env('TRAVIS_PASSWORD', 'test'),
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
          \Afrittella\LaravelAddressable\LaravelAddressableServiceProvider::class
        ];
    }
}
