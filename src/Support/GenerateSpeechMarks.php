<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Support;

use AhmadMayahi\Polly\Data\SpeechMark;
use AhmadMayahi\Polly\Enums\SpeechMarkType;
use AhmadMayahi\Polly\Exceptions\PollyException;
use AhmadMayahi\Polly\Polly;

class GenerateSpeechMarks
{
    private Polly $polly;

    public function __construct(Polly $polly)
    {
        $this->polly = clone $polly;
    }

    /**
     * @param SpeechMarkType ...$speechMarkType
     * @return array<SpeechMark>
     * @throws \JsonException
     */
    public function generate(SpeechMarkType ...$speechMarkType): array
    {
        $synthesize = $this->polly
            ->voiceId($this->polly->getVoiceId())
            ->asJson()
            ->text($this->polly->getText())
            ->withSpeechMarks(...$speechMarkType)
            ->getStreamContents();

        $speechMarkList = array_filter(explode(PHP_EOL, $synthesize));

        $list = array_map(function (string $markLine) {
            $markLine = trim($markLine);

            if (! $markLine) {
                return null;
            }

            $decodedMarkLine = json_decode($markLine, true, 512, JSON_THROW_ON_ERROR);

            return new SpeechMark(
                time: $decodedMarkLine['time'],
                type: $this->getSpeechMarkFromString($decodedMarkLine['type']),
                start: $decodedMarkLine['start'] ?? null,
                end: $decodedMarkLine['end'] ?? null,
                value: $decodedMarkLine['value'],
            );

        }, $speechMarkList);

        return array_filter($list);
    }

    protected function getSpeechMarkFromString($type): SpeechMarkType
    {
        if ($type === 'word') {
            return SpeechMarkType::Word;
        }

        if ($type === 'sentence') {
            return SpeechMarkType::Sentence;
        }

        if ($type === 'ssml') {
            return SpeechMarkType::Ssml;
        }

        if ($type === 'viseme') {
            return SpeechMarkType::Viseme;
        }

        throw new PollyException('Invalid mark type');
    }
}
