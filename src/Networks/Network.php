<?php

namespace MetaverseSystems\DockerPhpClient\Networks;

use MetaverseSystems\DockerPhpClient\Containers\Container;
use MetaverseSystems\DockerPhpClient\DockerClient;
use MetaverseSystems\DockerPhpClient\Networks\EndpointSettings;

class Network
{
    public $Name;
    public $Id;
    public $Created;
    public $Scope;
    public $CheckDuplicate = false;
    public $Driver = "bridge";
    public $EnableIPv6 = false;
    public $IPAM;
    public $Internal = true;
    public $Attachable = false;
    public $Ingress = false;
    public $Containers;
    public $Options;
    public $Labels;

    private DockerClient $client;

    public function __construct($config = null)
    {
        if($config === null) return;

        foreach($config as $k=>$v)
        {
            switch($k)
            {
                default:
                    $this->$k = $v;
                    break;
            }
        }
    }

    public function setClient(DockerClient $client)
    {
        $this->client = $client;
    }

    public function connect(Container $Container, EndpointSettings $EndpointConfig = null)
    {
        $this->network_connect($this, $Container, $EndpointConfig);
    }

    public function disconnect(Container $Container, $force = true)
    {
        $this->network_disconnect($this, $Container, $force);
    }

    public function save()
    {
        $this->client->network_create($this);
    }
}
