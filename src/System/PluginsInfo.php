<?php

namespace MetaverseSystems\DockerPhpClient\System;

/** Available plugins per type. */
class PluginsInfo
{
    /** Names of available authorization plugins. */
    public ?array $Authorization;

    /** Names of available logging-drivers, and logging-driver plugins. */
    public ?array $Log;

    /** Names of available network-drivers, and network-driver plugins. */
    public ?array $Network;

    /** Names of available volume-drivers, and network-driver plugins. */
    public ?array $Volume;

    public function __construct($config)
    {
        foreach($config as $k=>$v)
        {
            $this->$k = $v;
        }
    }
}
