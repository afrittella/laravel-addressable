<?php

namespace Afrittella\LaravelAddressable;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LaravelAddressableServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot(Router $router)
    {
        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php', 'laravel-addressable'
        );

        $this->loadMigrationsFrom(realpath(__DIR__.'/../database/migrations'));

        $this->publishFiles();
    }

    public function register()
    {

    }

    private function publishFiles()
    {
        // publish config file
        $this->publishes([__DIR__ . '/../config/config.php' => config_path() . '/laravel-addressable.php'], 'config');
    }
}