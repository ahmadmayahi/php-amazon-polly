<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Data;

use AhmadMayahi\Polly\Enums\SpeechMarkType;

class SpeechMark
{
    public function __construct(
        public int $time,
        public SpeechMarkType $type,
        public int $start,
        public int $end,
        public string $value
    ) {
    }
}
