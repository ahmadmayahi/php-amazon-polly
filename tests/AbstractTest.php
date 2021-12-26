<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Config;
use AhmadMayahi\Polly\Contracts\Voice;
use PHPUnit\Framework\TestCase;
use SplFileObject;

abstract class AbstractTest extends TestCase
{
    /** @after */
    public function setUp(): void
    {
        $tempPath = $this->getTempDir();
        $files = array_diff(scandir($tempPath), ['.', '..', '.gitignore']);

        foreach ($files as $file) {
            @unlink($tempPath . $file);
        }
    }

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

    protected function getTempDir(string $include = null): string
    {
        return dirname(__DIR__) . DIRECTORY_SEPARATOR . 'files/temp' . DIRECTORY_SEPARATOR . $include;
    }
}
