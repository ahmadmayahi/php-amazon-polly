<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Data;

use SplFileObject;

final class Speech
{
    /**
     * @param SplFileObject|null $file
     * @param array<SpeechMark>|null $speechMarks
     * @param float $took
     */
    public function __construct(
        public ?SplFileObject $file,
        public ?array $speechMarks,
        public float $took,
    ) {
    }
}
