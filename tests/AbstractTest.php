<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Config;
use PHPUnit\Framework\TestCase;

abstract class AbstractTest extends TestCase
{
    protected function getConfig()
    {
        return (new Config())
            ->setKey('key')
            ->setSecret('secret');
    }
}
