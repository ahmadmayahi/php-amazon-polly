<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMarkType;
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\EnglishUS;
use AhmadMayahi\Polly\Polly;
use AhmadMayahi\Polly\Utils\FileSystem;
use Aws\Polly\PollyClient;
use Aws\Result;

class SpeechTest extends AbstractTest
{
    /** @test */
    public function it_should_synthesize()
    {
        $result = $this->createMock(Result::class);

        $client = $this->createMock(PollyClient::class);
        $client
            ->expects($this->once())
            ->method('synthesizeSpeech')
            ->willReturn($result);

        $fileSystem = $this->createMock(FileSystem::class);

        $speech = new Polly($this->getConfig(), $client, $fileSystem);

        $speech
            ->voice(EnglishUS::Ivy)
            ->outputFormat(OutputFormat::mp3)
            ->text('To ensure that the metadata matches the associated audio stream, specify the same voice that is used to generate the synthesized speech audio stream. The available voices don\'t have identical speech rates. If you use a voice other than the one used to generate the speech, the metadata will not match the audio stream. ')
            ->textType(TextType::Text)
            ->speechMarks(SpeechMarkType::word)
            ->save();
    }
}
