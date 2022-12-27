<?php

namespace MetaverseSystems\DockerPhpClient\Images;

use MetaverseSystems\DockerPhpClient\Containers\ContainerConfig;
use MetaverseSystems\DockerPhpClient\DockerClient;

class Image
{
    /** Hardware CPU architecture that the image runs on. */
    public string $Architecture;

    /** Name of the author that was specified when committing the image, or as specified through MAINTAINER (deprecated) in the Dockerfile. */
    public string $Author;

    /** Optional message that was set when committing or importing the image. */
    public string $Comment;

    /** Config information for image. */
    public ContainerConfig $Config;

    /** The ID of the container that was used to create the image. */
    public string $Container;

    /** Configuration of container that was used to create the image. */
    public ContainerConfig $ContainerConfig;

    /** The version of Docker that was used to build the image. */
    public string $DockerVersion;

    /** ID is the content-addressable ID of an image. */
    public string $Id;

    /** ID of the parent image. */
    public string $Parent;

    /** List of content-addressable digests of locally available image manifests that the image is referenced from. */
    public $RepoDigests = array();

    /** List of image names/tags in the local image cache that reference this image. */
    public $RepoTags = array();

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
                case "ContainerConfig":
                    $this->ContainerConfig = new ContainerConfig($v);
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

    public function delete($force = false, $noprune = false)
    {
        $this->client->image_delete($this->Id, $force, $noprune);
    }
}
