# metaverse-systems/docker-php-client

PHP package for communicating with Docker Engine

* Install

```
composer require metaverse-systems/docker-php-client
```

* Publish config file

```
php artisan vendor:publish --provider="MetaverseSystems\DockerPhpClient\DockerPhpClientProvider" --tag=config
```

* In .env configure connection

```
DOCKER_API_HOST=http://localhost
DOCKER_API_SOCK=/var/run/docker.sock
```

* To use:

```
use MetaverseSystems\DockerPhpClient\Facades\DockerClient;

print_r(DockerClient::containers());

```
