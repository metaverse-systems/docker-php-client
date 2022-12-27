<?php

namespace MetaverseSystems\DockerPhpClient\System;

use MetaverseSystems\DockerPhpClient\System\PluginsInfo;

class System
{
    /** Indicates if bridge-nf-call-iptables is available on the host. */
    public bool $BridgeNfIptables;

    /** Indicates if bridge-nf-call-ip6tables is available on the host. */
    public bool $BridgeNfIp6tables;

    /** Total number of containers on the host. */
    public int $Containers;

    /** Number of containers with status "running". */
    public int $ContainersRunning;

    /** Number of containers with status "paused". */
    public int $ContainersPaused;

    /** Number of containers with status "stopped". */
    public int $ContainersStopped;

    /** Indicates if CPU CFS(Completely Fair Scheduler) period is supported by the host. */
    public bool $CpuCfsPeriod;

    /** Indicates if CPU CFS(Completely Fair Scheduler) quota is supported by the host. */
    public bool $CpuCfsQuota;

    /** Indicates if CPUsets (cpuset.cpus, cpuset.mems) are supported by the host. */
    public bool $CPUSet;

    /** Indicates if CPU Shares limiting is supported by the host. */
    public bool $CPUShares;

    /** Indicates if the daemon is running in debug-mode / with debug-level logging enabled. */
    public bool $Debug;

    /** Root directory of persistent Docker state. */
    public string $DockerRootDir;

    /** Name of the storage driver in use. */
    public string $Driver;

    /** 
     * Information specific to the storage driver, provided as "label" / "value" pairs.
     *
     * Note: The information returned in this field,
     * including the formatting of values and labels,
     * should not be considered stable,
     * and may change without notice.
     */
    public array $DriverStatus;

    /** 
     * Unique identifier of the daemon.
     *
     * Note: The format of the ID itself is not part of the API,
     * and should not be considered stable.
     */
    public string $ID;

    /** Total number of images on the host. */
    public int $Images;

    /** Indicates IPv4 forwarding is enabled. */
    public bool $IPv4Forwarding;

    /** Indicates if the host has kernel memory limit support enabled. */
    public bool $KernelMemory;

    /** Indicates if the host has kernel memory TCP limit support enabled. */
    public bool $KernelMemoryTCP;

    /** Indicates if the host has memory limit support enabled. */
    public bool $MemoryLimit;

    /** The total number of file Descriptors in use by the daemon process. */
    public int $NFd;

    /** The number of goroutines that currently exist. */
    public int $NGoroutines;

    /** Indicates if OOM killer disable is supported on the host. */
    public bool $OomKillDisable;

    /** Indicates if the host kernel has PID limit support enabled. */
    public bool $PidsLimit;

    /** Available plugins per type. */
    public PluginsInfo $Plugins;

    /** Indicates if the host has memory swap limit support enabled. */
    public bool $SwapLimit;

    /** Current system-time in RFC 3339 format with nano-seconds. */
    public string $SystemTime;

    public function __construct($config = null)
    {
        if($config === null) return;

        foreach($config as $k=>$v)
        {
            switch($k)
            {
                case "Plugins":
                    $this->$k = new PluginsInfo($v);
                    break;
                default:
                    $this->$k = $v;
                    break;
            }
        }
    }
}
