<?php

namespace MetaverseSystems\DockerPhpClient\System;

use MetaverseSystems\DockerPhpClient\System\System;

trait SystemTrait
{
    public function auth(string $username, string $password, string $email, string $serveraddress): \stdClass
    {
        $url = "/auth";

        $parameters = array();
        $parameters["username"] = $username;
        $parameters["password"] = $password;
        $parameters["email"] = $email;
        $parameters["serveraddress"] = $serveraddress;

        $result = $this->post($url, null, $parameters);

        return $result;
    }

    public function info(): System
    {
        $url = "/info";

        $result = $this->get($url);

        return new System($result);
    }
}
