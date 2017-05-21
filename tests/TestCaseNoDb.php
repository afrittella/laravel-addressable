<?php

namespace Tests;

//use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCaseNoDb extends BaseTestCase
{
    //use CreatesApplication;

    public function setUp()
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            \Afrittella\LaravelAddressable\LaravelAddressableServiceProvider::class,
            \PragmaRX\Countries\ServiceProvider::class,
        ];
    }
}
