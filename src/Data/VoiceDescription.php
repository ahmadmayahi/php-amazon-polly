<?php

namespace AhmadMayahi\Polly\Data;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Enums\Gender;

class VoiceDescription
{
    public function __construct(
        public Voice $name,
        public Gender $gender,
        public bool $neural,
        public bool $standard,
        public bool $bilingual = false,
        public bool $newscaster = false,
        public bool $child = false
    ) {
    }
}
