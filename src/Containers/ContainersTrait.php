<?php

namespace MetaverseSystems\DockerPhpClient\Containers;

use MetaverseSystems\DockerPhpClient\Containers\Container;
use MetaverseSystems\DockerPhpClient\Containers\ContainerConfig;
use MetaverseSystems\DockerPhpClient\Containers\ContainerState;
use MetaverseSystems\DockerPhpClient\Containers\HostConfig;

trait ContainersTrait
{
    private function JSONtoContainer($json): Container
    {
        $container = new Container($this);
        foreach($json as $k=>$v)
        {
            switch($k)
            {
                case "Config":
                    $container->Config = new ContainerConfig($v);
                    break;
                case "HostConfig":
                    $container->HostConfig = new HostConfig($v);
                    break;
                case "State":
                    $container->State = new ContainerState();
                    break;
                default:
                    $container->$k = $v;
                    break;
            }
        }
        return $container;
    }

    public function containers($all = false, $limit = null, $size = false, $filters = null): array
    {
        $url = "/containers/json";

        $parameters = array();
        $parameters["all"] = $all;
        $parameters["limit"] = $limit;
        $parameters["size"] = $size;
        $parameters["filters"] = $filters;
        $result = $this->get($url, $parameters);

        $containers = array();
        foreach($result as $config)
        {
            $container = new Container($config);
            $container->setClient($this);
            array_push($containers, $container);
        }
        return $containers;
    }

    public function container($id, $size = false): Container
    {
        $url = "/containers/$id/json";

        $parameters = array();
        $parameters["size"] = $size;
        $result = $this->get($url, $parameters);

        $container = new Container($result);
        $container->setClient($this);
        return $container;
    }

    public function container_delete($id, $v = false, $force = false, $link = false)
    {
        $url = "/containers/$id";

        $parameters = array();
        $parameters["v"] = $v;
        $parameters["force"] = $force;
        $parameters["link"] = $link;

        return $this->delete($url, $parameters);
    }

    public function container_create(Container $Container, $platform = null)
    {
        $url = "/containers/create?";
        if($Container->name) $url.= "name=".$Container->name."&";
        if($platform) $url.= "platform=$platform&";
        
        $result = $this->post($url, $Container);
        return;
    }

    public function container_new($Name)
    {
        $container = new Container();
        $container->setClient($this);
        $container->Name = $Name;
        return $container;
    }

    public function container_start(Container $Container)
    {
        $url = "/containers/".$Container->Id."/start";
        return $this->post($url, null, null);
    }
}
