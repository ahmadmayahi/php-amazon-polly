<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Support;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;

class VoiceDescriptionFactory
{
    public static function generate(
        Voice $voice,
        Gender $gender,
        bool $neural,
        bool $standard,
        bool $bilingual = false,
        bool $newscaster = false,
        bool $child = false
    ): VoiceDescription {
        return new VoiceDescription(
            name: $voice,
            gender: $gender,
            neural: $neural,
            standard: $standard,
            bilingual: $bilingual,
            newscaster: $newscaster,
            child: $child
        );
    }
}
