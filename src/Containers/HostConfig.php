<?php

namespace MetaverseSystems\DockerPhpClient\Containers;

/** A container's resources (cgroups config, ulimits, etc) */
class HostConfig
{
    public function __construct($config)
    {
        foreach($config as $k=>$v) $this->$k = $v;
    }
}
