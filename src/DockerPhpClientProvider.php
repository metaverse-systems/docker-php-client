<?php

namespace MetaverseSystems\DockerPhpClient;

use Illuminate\Support\ServiceProvider;

class DockerPhpClientProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('docker-php-client.php'),
        ], 'config');

        $this->app->bind('docker-php-client', function($app) {
            return new DockerClient(config('docker-php-client.host'), config('docker-php-client.sock'));
        });
    }
}

