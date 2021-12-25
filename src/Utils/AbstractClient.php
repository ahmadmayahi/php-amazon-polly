<?php

namespace AhmadMayahi\Polly\Utils;

use AhmadMayahi\Polly\Config;
use Aws\Polly\PollyClient;

abstract class AbstractClient
{
    public function __construct(protected Config $config, protected PollyClient $client, protected FileSystem $fileSystem)
    {
    }

    public static function init(Config $config, ?PollyClient $client = null): static
    {
        $client ??= new PollyClient($config->clientConfig());

        return new static($config, $client, new FileSystem(sys_get_temp_dir()));
    }

    protected function client(): PollyClient
    {
        return $this->client;
    }
}
