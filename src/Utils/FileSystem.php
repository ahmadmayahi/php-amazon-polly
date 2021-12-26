<?php

namespace AhmadMayahi\Polly\Utils;

use SplFileObject;

class FileSystem
{
    public function __construct(private string $tempDirPath)
    {
    }

    public function getTempDir(string $include = null): string
    {
        return $this->tempDirPath . ($include ? DIRECTORY_SEPARATOR . $include : null);
    }

    public function getTempFileName(): string
    {
        return tempnam(
            $this->getTempDir(),
            $this->generateRandomFileName()
        );
    }

    public function generateRandomFileName(): string
    {
        return sha1(uniqid() . time());
    }

    public function save($path, $contents): SplFileObject
    {
        file_put_contents($path, $contents);

        return new SplFileObject($path);
    }
}
