<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMark;
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Polly;
use AhmadMayahi\Polly\Utils\FileSystem;
use Aws\Polly\PollyClient;
use Aws\Result;
use GuzzleHttp\Psr7\Stream;

final class SpeechTest extends AbstractTest
{
    /** @test */
    public function it_should_get_stream_contents(): void
    {
        $stream = $this->createMock(Stream::class);
        $stream
            ->expects($this->once())
            ->method('getContents')
            ->willReturn($this->voiceFileContents(UnitedStates::Joanna));

        $result = new Result([
            'AudioStream' => $stream,
        ]);

        $client = $this->createMock(PollyClient::class);
        $client
            ->expects($this->once())
            ->method('__call')
            ->willReturn($result);

        $fileSystem = $this->createMock(FileSystem::class);

        $polly = new Polly($this->getConfig(), $client, $fileSystem);

        $polly
            ->voice(UnitedStates::Ivy)
            ->outputFormat(OutputFormat::Mp3)
            ->text('Hello World')
            ->textType(TextType::Text)
            ->getStreamContents();
    }

    /** @test */
    public function it_should_generate_speech_marks(): void
    {
        $joanna = $this->voiceFileContents(UnitedStates::Joanna);
        $joannaSpl = $this->voiceFile(UnitedStates::Joanna);

        $audioStream = $this->createMock(Stream::class);
        $audioStream
            ->expects($this->once())
            ->method('getContents')
            ->willReturn($joanna);

        $audioResult = new Result([
            'AudioStream' => $audioStream,
        ]);

        $jsonStream = $this->createMock(Stream::class);
        $jsonStream
            ->expects($this->once())
            ->method('getContents')
            ->willReturn('
                {"time":6,"type":"word","start":0,"end":5,"value":"Hello"}
                {"time":374,"type":"word","start":6,"end":11,"value":"World"}');

        $jsonResult = new Result([
            'AudioStream' => $jsonStream,
        ]);

        $client = $this->createMock(PollyClient::class);
        $client
            ->expects($this->exactly(2))
            ->method('__call')
            ->willReturnOnConsecutiveCalls($jsonResult, $audioResult);

        $fileSystem = $this->createMock(FileSystem::class);
        $fileSystem
            ->expects($this->once())
            ->method('save')
            ->willReturn($joannaSpl);

        $polly = new Polly($this->getConfig(), $client, $fileSystem);

        $speechFile = $polly
            ->voice(UnitedStates::Ivy)
            ->outputFormat(OutputFormat::Mp3)
            ->text('Hello World')
            ->textType(TextType::Text)
            ->speechMarks(SpeechMark::Word)
            ->convert();

        $this->assertEquals([
            (object) [
                'time' => 6,
                'type' => 'word',
                'start' => 0,
                'end' => 5,
                'value' => 'Hello',
            ],
            (object) [
                'time' => 374,
                'type' => 'word',
                'start' => 6,
                'end' => 11,
                'value' => 'World',
            ],
        ], $speechFile->speechMarks);

        $this->assertSame($joannaSpl, $speechFile->file);
    }
}
