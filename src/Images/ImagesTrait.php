<?php

namespace MetaverseSystems\DockerPhpClient\Images;

use MetaverseSystems\DockerPhpClient\Images\Image;

trait ImagesTrait
{
    public function images($all = false, $filters = null, $digests = false): array
    {
        $url = "/images/json";

        $parameters = array();
        $parameters["all"] = $all;
        $parameters["filters"] = $filters;
        $parameters["digests"] = $digests;
        $result = $this->get($url, $parameters);

        $images = array();
        foreach($result as $config)
        {
            $image = new Image($config);
            $image->setClient($this);
            array_push($images, $image);
        }
        return $images;
    }

    public function image($name): Image
    {
        $url = "/images/$name/json";

        $result = $this->get($url);

        $image = new Image($result);
        $image->setClient($this);
        return $image;
    }

    public function image_delete($id, $force = false, $noprune = false)
    {
        $url = "/images/$id";

        $parameters = array();
        $parameters["force"] = $force;
        $parameters["noprune"] = $noprune;

        $result = $this->delete($url, $parameters);
        print_r($result);
        return;
    }

    public function image_create(string $fromImage = null, string $fromSrc = null, string $repo = null,
                                 string $tag = null, string $message = null, $changes = array(),
                                 string $platform = null)
    {
        $url = "/images/create";

        $parameters = array();
        $parameters["fromImage"] = $fromImage;
        $parameters["fromSrc"] = $fromSrc;
        $parameters["repo"] = $repo;
        $parameters["tag"] = $tag;
        $parameters["message"] = $message;
        $parameters["changes"] = $changes;
        $parameters["platform"] = $platform;

        $result = $this->post($url, null, $parameters);

        return $result;
    }
}
