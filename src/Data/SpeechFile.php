<?php

namespace AhmadMayahi\Polly\Data;

use SplFileObject;

class SpeechFile
{
    public function __construct(
        public SplFileObject $file,
        public array $speechMarks = []
    )
    {
    }
}
