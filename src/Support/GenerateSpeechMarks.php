<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Support;

use AhmadMayahi\Polly\Data\SpeechMark;
use AhmadMayahi\Polly\Enums\SpeechMarkType;
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

            $decodedMarkLine = json_decode($markLine);

            return new SpeechMark(
                $decodedMarkLine->time,
                $this->getSpeechMarkFromString($decodedMarkLine->type),
                $decodedMarkLine->start,
                $decodedMarkLine->end,
                $decodedMarkLine->value,
            );
        }, $speechMarkList);

        return array_filter($list);
    }

    protected function getSpeechMarkFromString($type)
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
    }
}
