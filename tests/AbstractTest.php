<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Config;
use AhmadMayahi\Polly\Contracts\Voice;
use PHPUnit\Framework\TestCase;
use SplFileObject;

abstract class AbstractTest extends TestCase
{
    protected function getConfig(): Config
    {
        return (new Config())
            ->setKey('key')
            ->setSecret('secret');
    }

    protected function voiceFileContents(Voice $voice): string
    {
        return file_get_contents($this->getVoicePathName($voice));
    }

    protected function voiceFile(Voice $voice): SplFileObject
    {
        return new SplFileObject($this->getVoicePathName($voice));
    }

    protected function getVoicePathName(Voice $voice): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'files/voices/' . strtolower($voice->name).'.mp3';
    }
}
