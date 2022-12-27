<?php

namespace MetaverseSystems\DockerPhpClient\Containers;

/** Information about the storage driver used to store the container's and image's filesystem. */
class GraphDriverData
{
    public function __construct($config)
    {
        foreach($config as $k=>$v)
        {
            $this->$k = $v;
        }
    }
}
