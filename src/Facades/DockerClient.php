<?php

namespace MetaverseSystems\DockerPhpClient\Facades;

use Illuminate\Support\Facades\Facade;

class DockerClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'docker-php-client';
    }
}

