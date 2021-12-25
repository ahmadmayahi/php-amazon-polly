<?php

namespace AhmadMayahi\Polly;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\SpeechFile;
use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMarkType;
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Exceptions\PollyException;
use AhmadMayahi\Polly\Utils\AbstractClient;
use Aws\Result;
use Generator;
use Throwable;

class Polly extends AbstractClient
{
    private Voice $voice;

    private OutputFormat $outputFormat = OutputFormat::mp3;

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

    public function save(string $path = null): SpeechFile
    {
        $path ??= $this->fileSystem->getTempFileName($this->getOutputFormat());

        $speechMarks = [];

        if ($this->speechMarks) {
            $speechMarks = $this->generateSpeechMarks(...$this->speechMarks);
            $speechMarks = array_filter(iterator_to_array($speechMarks));
        }

        return new SpeechFile(
            $this->fileSystem->save($path, $this->getStreamContents()),
            $speechMarks,
        );
    }

    private function generateSpeechMarks(SpeechMarkType ...$speechMarkType): Generator
    {
        $speechMarksList = (new self($this->config, $this->client, $this->fileSystem))
            ->voice($this->voice)
            ->outputFormat(OutputFormat::json)
            ->text($this->text)
            ->textType($this->textType)
            ->speechMarks(...$speechMarkType)
            ->getStreamContents();

        foreach (explode(PHP_EOL, $speechMarksList) as $item) {
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

    public function speechMarks(SpeechMarkType ...$speechMarkType): static
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

        if ($this->speechMarks && $this->outputFormat === OutputFormat::json) {
            $list['SpeechMarkTypes'] = array_map(fn($item) => $item->name, $this->speechMarks);
        }

        return $list;
    }
}
