<?php

namespace MetaverseSystems\DockerPhpClient\Containers;

use MetaverseSystems\DockerPhpClient\Containers\ContainerConfig;
use MetaverseSystems\DockerPhpClient\Containers\ContainerState;
use MetaverseSystems\DockerPhpClient\Containers\GraphDriverData;
use MetaverseSystems\DockerPhpClient\Containers\HostConfig;
use MetaverseSystems\DockerPhpClient\DockerClient;

class Container
{
    public $AppArmorProfile;
    public $Args;
    public $Command;
    public ContainerConfig $Config;
    public $Created;
    public $Driver;
    public $ExecIDs = array();
    public $Env = array();
    public GraphDriverData $GraphDriver;
    public HostConfig $HostConfig;
    public $HostnamePath;
    public $HostsPath;
    public $Id;
    public $Image;
    public $ImageID;
    public $Labels;
    public $LogPath;
    public $MountLabel;
    public $Mounts = array();
    public $Name;
    public $NetworkSettings;
    public $Path;
    public $Platform;
    public $Ports = array();
    public $ProcessLabel;
    public $ResolvConfPath;
    public $RestartCount;
    public $SizeRw;
    public $SizeRootFs;
    public ContainerState $State;
    public $Status;

    private ?DockerClient $client = null;

    public function __construct($config = null)
    {
        if($config === null) return;

        foreach($config as $k=>$v)
        {
            switch($k)
            {
                case "Config":
                    $this->Config = new ContainerConfig($v);
                    break;
                case "GraphDriver":
                    $this->GraphDriver = new GraphDriverData($v);
                    break;
                case "HostConfig":
                    $this->HostConfig = new HostConfig($v);
                    break;
                case "State":
                    $this->State = new ContainerState();
                    break;
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

    public function save()
    {
        if($this->client === null)
        {
            throw new \ErrorException("Container::\$client not set to a valid MetaverseSystems\\DockerPhpClient\\DockerClient object.");
        }

        $this->client->container_create($this);
    }

    public function start()
    {
        if($this->client === null)
        {
            throw new \ErrorException("Container::\$client not set to a valid MetaverseSystems\\DockerPhpClient\\DockerClient object.");
        }

        $this->client->container_start($this);
    }
}
