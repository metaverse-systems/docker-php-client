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
print "DockerPhpClientProvider::boot()\n";
/*
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('docker-php-client.php'),
        ], 'config');
*/
    }
}

