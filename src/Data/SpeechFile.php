<?php

namespace AhmadMayahi\Polly\Data;

use SplFileObject;

final class SpeechFile
{
    public function __construct(
        public SplFileObject $file,
        public array $speechMarks = []
    ) {
    }
}
