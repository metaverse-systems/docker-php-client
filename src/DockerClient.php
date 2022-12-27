<?php

namespace MetaverseSystems\DockerPhpClient;

use MetaverseSystems\DockerPhpClient\Containers\ContainersTrait;
use MetaverseSystems\DockerPhpClient\Images\ImagesTrait;
use MetaverseSystems\DockerPhpClient\Networks\NetworksTrait;
use MetaverseSystems\DockerPhpClient\System\SystemTrait;

class DockerClient
{
    use ContainersTrait, ImagesTrait, NetworksTrait, SystemTrait;

    private $host;
    private $sock;

    public function __construct($host, $sock = null)
    {
        $this->host = $host;
        $this->sock = $sock;
    }

    public function get($url, $parameters = array())
    {
        if(count($parameters))
        {
            $i = 0;
            foreach($parameters as $k=>$v)
            {
                if($i == 0) $url.= "?$k=$v";
                else $url.= "&$k=$v";
                $i++;
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host.$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($this->sock)
        {
            curl_setopt($ch, CURLOPT_UNIX_SOCKET_PATH, $this->sock);
        }
        if(!$result = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
        }

        $http_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        if($http_code != 200)
        {
            throw new \ErrorException(json_decode($result)->message);
        }

        curl_close($ch);
        return json_decode($result);
    }

    public function post($url, $obj, $parameters = array())
    {
        if(count($parameters))
        {
            $i = 0;
            foreach($parameters as $k=>$v)
            {
                if($i == 0) $url.= "?$k=$v";
                else $url.= "&$k=$v";
                $i++;
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host.$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_POST, true);
        if($this->sock)
        {
            curl_setopt($ch, CURLOPT_UNIX_SOCKET_PATH, $this->sock);
        }

        if($obj !== null)
        {
            $payload = json_encode($obj);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        }

        if(!$result = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
        }

        $http_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        if($http_code != 200)
        {
            throw new \ErrorException(json_decode($result)->message);
        }

        curl_close($ch);
        return json_decode($result);
    }

    public function delete($url, $parameters = array())
    {
        if(count($parameters))
        {
            $i = 0;
            foreach($parameters as $k=>$v)
            {
                if($i == 0) $url.= "?$k=$v";
                else $url.= "&$k=$v";
                $i++;
            }
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host.$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        if($this->sock)
        {
            curl_setopt($ch, CURLOPT_UNIX_SOCKET_PATH, $this->sock);
        }

        if(!$result = curl_exec($ch))
        {
            trigger_error(curl_error($ch));
        }

        $http_code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        if($http_code != 200)
        {
            throw new \ErrorException(json_decode($result)->message);
        }

        curl_close($ch);
        return json_decode($result);
    }
}
