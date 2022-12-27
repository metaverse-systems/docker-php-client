<?php

namespace MetaverseSystems\DockerPhpClient\Containers;

/** Configuration for a container that is portable between hosts. */
class ContainerConfig
{
    /** The hostname to use for the container, as a valid RFC 1123 hostname. */
    public string $Hostname;

    /** The domain name to use for the container. */
    public string $Domainname;

    /** The user that commands are run as inside the container. */
    public string $User;

    /** Whether to attach to stdin. */
    public bool $AttachStdin = false;

    /** Whether to attach to stdout. */
    public bool $AttachStdout = true;

    /** Whether to attach to stderr. */
    public bool $AttachStderr = true;

    /**
     * An object mapping ports to an empty object in the form:
     * {"<port>/<tcp|udp|sctp>": {}}
     */
    public object|null $ExposedPorts = null;

    /** Attach standard streams to a TTY, including stdin if it is not closed. */
    public bool $Tty = false;

    /** Open stdin. */
    public bool $OpenStdin = false;

    /** Close stdin after one attached client disconnects. */
    public bool $StdinOnce = false;

    public function __construct($config)
    {
        foreach($config as $k=>$v)
        {
            $this->$k = $v;
        }
    }
}
