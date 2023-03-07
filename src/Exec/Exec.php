<?php

namespace MetaverseSystems\DockerPhpClient\Exec;

use MetaverseSystems\DockerPhpClient\DockerClient;
use MetaverseSystems\DockerPhpClient\Containers\Container;

class Exec
{
    public $AttachStdin;
    public $AttachStdout;
    public $AttachStderr;
    public $Cmd = array();
    public $DetachKeys;
    public $Env = array();
    public $ID;
    public $Privileged = false;
    public $Tty;
    public $User;
    public $WorkingDir;

    private ?DockerClient $client = null;

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

    public function save(Container $Container)
    {
        if($this->client === null)
        {
            throw new \ErrorException("Exec::\$client not set to a valid MetaverseSystems\\DockerPhpClient\\DockerClient object.");
        }

        return $this->client->exec_create($this, $Container);
    }

    public function start($config)
    {
        if($this->client === null)
        {
            throw new \ErrorException("Exec::\$client not set to a valid MetaverseSystems\\DockerPhpClient\\DockerClient object.");
        }

        $this->client->exec_start($this, $config);
    }
}
