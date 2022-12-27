<?php

namespace MetaverseSystems\DockerPhpClient\Networks;

use MetaverseSystems\DockerPhpClient\Networks\EndpointIPAMConfig;
use MetaverseSystems\DockerPhpClient\Networks\DriverOpts;

/**
 * Configuration for a network endpoint.
 */
class EndpointSettings
{
    public $Aliases = array();

    public DriverOpts $DriverOpts = null;

    /** Unique ID for the service endpoint in a Sandbox. */
    public $EndpointID;

    /** Gateway address for this network. */
    public $Gateway;

    /** IPv4 address. */
    public $IPAddress;

    public EndpointIPAMConfig $IPAMConfig = null;

    /** Mask length of the IPv4 address. */
    public $IPPrefixLen;

    /** IPv6 gateway address. */
    public $IPv6Gateway;

    /** Global IPv6 address. */
    public $GlobalIPv6Address;

    /** Mask length of the global IPv6 address. */
    public $GlobalIPv6PrefixLen;

    public $Links = array();

    /** MAC address for the endpoint on this network. */
    public $MacAddress;

    /** Unique ID of the network. */
    public $NetworkID;
}
