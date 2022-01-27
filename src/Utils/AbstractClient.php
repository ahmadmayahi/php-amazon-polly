<?php

namespace AhmadMayahi\Polly\Utils;

use AhmadMayahi\Polly\Config;
use AhmadMayahi\Polly\Measurement;
use Aws\Polly\PollyClient;

abstract class AbstractClient
{
    protected Measurement $measurement;

    public function __construct(protected Config $config, protected PollyClient $client, protected FileSystem $fileSystem, Measurement $measurement)
    {
        $this->measurement = $measurement->begin();
    }

    public static function init(Config $config, ?PollyClient $client = null, ?Measurement $measurement = null): static
    {
        $client ??= new PollyClient($config->clientConfig());

        $measurement ??= new Measurement();

        return new static($config, $client, new FileSystem(sys_get_temp_dir()), $measurement);
    }

    protected function client(): PollyClient
    {
        return $this->client;
    }
}
