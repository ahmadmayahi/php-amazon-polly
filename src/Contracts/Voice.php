<?php

namespace AhmadMayahi\Polly\Contracts;

use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Language;

interface Voice
{
    public function describe(): VoiceDescription;

    public function language(): Language;
}
