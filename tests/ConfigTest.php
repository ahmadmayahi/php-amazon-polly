<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Config;

class ConfigTest extends AbstractTest
{
    /** @test */
    public function it_should_create_config(): void
    {
        $config = (new Config())
            ->setKey('key')
            ->setSecret('secret')
            ->setRegion('eu-east-1')
            ->debug();

        $expected = [
            'version' => 'latest',
            'region' => 'eu-east-1',
            'debug' => true,
            'credentials' => [
                'key' => 'key',
                'secret' => 'secret',
            ],
        ];

        $this->assertEquals($expected, $config->clientConfig());
    }
}
