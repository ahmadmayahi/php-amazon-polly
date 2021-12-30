<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\SpeechFile;
use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMark;
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Exceptions\PollyException;
use AhmadMayahi\Polly\Utils\AbstractClient;
use Aws\Result;
use Generator;
use Throwable;

class Polly extends AbstractClient
{
    private Voice $voice;

    private OutputFormat $outputFormat = OutputFormat::Mp3;

    private TextType $textType = TextType::Text;

    private string $text;

    private array $speechMarks = [];

    public function synthesize(): Result
    {
        try {
            return $this->client()->synthesizeSpeech($this->speechConfig());
        } catch (Throwable $exception) {
            throw new PollyException($exception->getMessage());
        }
    }

    public function getStreamContents()
    {
        return $this->synthesize()->get('AudioStream')->getContents();
    }

    public function convert(string $path = null): SpeechFile
    {
        $path ??= $this->fileSystem->getTempFileName();

        $speechMarks = [];

        if ($this->speechMarks) {
            $speechMarks = $this->generateSpeechMarks(...$this->speechMarks);
            $speechMarks = iterator_to_array($speechMarks);
        }

        return new SpeechFile(
            $this->outputFormat !== OutputFormat::Json ? $this->fileSystem->save($path, $this->getStreamContents()) : null,
            $speechMarks,
        );
    }

    private function generateSpeechMarks(SpeechMark ...$speechMarkType): Generator
    {
        $speechMarksList = (new self($this->config, $this->client, $this->fileSystem))
            ->voice($this->voice)
            ->outputFormat(OutputFormat::Json)
            ->text($this->text)
            ->textType($this->textType)
            ->speechMarks(...$speechMarkType)
            ->getStreamContents();

        $list = array_filter(explode(PHP_EOL, $speechMarksList));

        foreach ($list as $item) {
            $item = trim($item);

            if (! $item) {
                continue ;
            }

            yield json_decode($item);
        }
    }

    public function voice(Voice $voice): static
    {
        $this->voice = $voice;

        return $this;
    }

    public function outputFormat(OutputFormat $output): static
    {
        $this->outputFormat = $output;

        return $this;
    }

    public function text(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getVoice(): string
    {
        return $this->voice->name;
    }

    public function getOutputFormat(): string
    {
        return $this->outputFormat->value;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function textType(TextType $textType): static
    {
        $this->textType = $textType;

        return $this;
    }

    public function getTextType(): string
    {
        return $this->textType->value;
    }

    public function speechMarks(SpeechMark ...$speechMarkType): static
    {
        $this->speechMarks = $speechMarkType;

        return $this;
    }

    private function speechConfig(): array
    {
        $list = [
            'Text' => $this->getText(),
            'OutputFormat' => $this->getOutputFormat(),
            'TextType' => $this->getTextType(),
            'VoiceId' => $this->getVoice(),
        ];

        if ($this->speechMarks && $this->outputFormat === OutputFormat::Json) {
            $list['SpeechMarkTypes'] = array_map(fn ($item) => $item->value, $this->speechMarks);
        }

        return $list;
    }
}
