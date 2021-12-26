<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Tests\Utils;

use AhmadMayahi\Polly\Tests\AbstractTest;
use AhmadMayahi\Polly\Utils\FileSystem;

class FileSystemTest extends AbstractTest
{
    /** @test */
    public function it_should_get_correct_temporary_dir()
    {
        $fileSystem = new FileSystem($this->getTempDir());

        $this->assertEquals($this->getTempDir(), $fileSystem->getTempDir());
    }

    /** @test */
    public function it_should_get_correct_temporary_filename(): void
    {
        $fileSystem = new FileSystem($this->getTempDir());

        $this->assertFileExists($fileSystem->getTempFileName());
    }

    /** @test */
    public function it_should_save_file(): void
    {
        $fileSystem = new FileSystem($this->getTempDir());

        $fileSystem->save($this->getTempDir('greeting'), 'Hello World');

        $this->assertFileExists($this->getTempDir('greeting'));

        $this->assertEquals('Hello World', file_get_contents($this->getTempDir('greeting')));
    }
}
