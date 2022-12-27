<?php

namespace MetaverseSystems\DockerPhpClient\Networks;

use MetaverseSystems\DockerPhpClient\Containers\Container;
use MetaverseSystems\DockerPhpClient\Networks\EndpointSettings;
use MetaverseSystems\DockerPhpClient\Networks\Network;

trait NetworksTrait
{
    public function networks($filters = ""): array
    {
        $url = "/networks";

        $parameters = array();
        if($filters) $parameters["filters"] = $filters;
        $result = $this->get($url, $parameters);

        $networks = array();
        foreach($result as $network)
        {
            $n = new Network($network);
            $n->setClient($this);
            array_push($networks, $n);
        }
        return $networks;
    }

    public function network($id, $verbose = false, $scope = ""): Network
    {
        $url = "/networks/$id";

        $parameters = array();
        $parameters["verbose"] = $verbose;
        $parameters["scope"] = $scope;
        $network = new Network($this->get($url, $parameters));
        $network->setClient($this);
        
        return $network;
    }

    public function network_delete($id)
    {
        $url = "/networks/$id";

        return $this->delete($url);
    }

    public function network_create(Network $Network)
    {
        $url = "/networks/create";

        return $this->post($url, $Network);
    }

    public function network_new($Name): Network
    {
        $network = new Network();
        $network->setClient($this);
        $network->Name = $Name;
        return $network;
    }

    public function network_connect(Network $Network, Container $Container, EndpointSettings $EndpointConfig = null)
    {
        $url = "/networks/".$Network->Id."/connect";

        $body = new \stdClass;
        $body->Container = $Container->Id;
        $body->EndpointConfig = $EndpointConfig;

        return $this->post($url, $body);
    }

    public function network_disconnect(Network $Network, Container $Container, $Force = true)
    {
        $url = "/networks/".$Network->Id."/disconnect";

        $body = new \stdClass;
        $body->Container = $Container->Id;
        $body->Force = $Force;

        return $this->post($url, $body);
    }
}
