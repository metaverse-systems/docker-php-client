<?php

namespace MetaverseSystems\DockerPhpClient\Exec;

use MetaverseSystems\DockerPhpClient\Exec\Exec;
use MetaverseSystems\DockerPhpClient\Containers\Container;

trait ExecTrait
{
    public function exec($id): Exec
    {
        $url = "/exec/$id/json";

        $result = $this->get($url);

        $Exec = new Exec($result);
        $Exec->setClient($this);
        return $Exec;
    }

    public function exec_create(Exec $Exec, Container $Container)
    {
        $url = "/containers/".$Container->Id."/exec";
        
        $result = $this->post($url, $Exec);
        return $result;
    }

    public function exec_new()
    {
        $Exec = new Exec();
        $Exec->setClient($this);
        return $Exec;
    }

    public function exec_start(Exec $Exec, $config)
    {
        $url = "/exec/".$Exec->ID."/start";
print "exec_start url: $url\n";
        return $this->post($url, $config, null);
    }
}
