<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Data\SpeechMark;
use AhmadMayahi\Polly\Enums\SpeechMarkType;
use AhmadMayahi\Polly\Measurement;
use AhmadMayahi\Polly\Polly;
use AhmadMayahi\Polly\Support\FileSystem;
use AhmadMayahi\Polly\Voices\English\UnitedStates;
use Aws\Polly\PollyClient;
use Aws\Result;
use GuzzleHttp\Psr7\Stream;

final class PollyTest extends AbstractTest
{
    /** @test */
    public function can_initiate_polly_client(): void
    {
        $this->assertInstanceOf(
            Polly::class,
            Polly::init($this->getConfig(), $this->createMock(PollyClient::class), new Measurement())
        );
    }

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

        $polly = new Polly($this->getConfig(), $client, $fileSystem, new Measurement());

        $polly
            ->voiceId(UnitedStates::Ivy)
            ->asMp3()
            ->text('Hello World')
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
            ->willReturn('{"time":6,"type":"word","start":0,"end":5,"value":"Hello"}'.PHP_EOL.'{"time":374,"type":"word","start":6,"end":11,"value":"World"}');

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

        $polly = new Polly($this->getConfig(), $client, $fileSystem, new Measurement());

        $speechFile = $polly
            ->voiceId(UnitedStates::Ivy)
            ->asMp3()
            ->text('Hello World')
            ->withSpeechMarks(SpeechMarkType::Word)
            ->convert();

        $this->assertEquals([
            new SpeechMark(
                time: 6,
                type: SpeechMarkType::Word,
                start: 0,
                end: 5,
                value: 'Hello',
            ),
            new SpeechMark(
                time: 374,
                type: SpeechMarkType::Word,
                start: 6,
                end: 11,
                value: 'World',
            ),
        ], $speechFile->speechMarks);

        $this->assertSame($joannaSpl, $speechFile->file);
    }
}
