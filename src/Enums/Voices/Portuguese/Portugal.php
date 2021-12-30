<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums\Voices\Portuguese;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Utils\VoiceDescriptionFactory;

enum Portugal implements Voice
{
    case Ines;

    case Cristiano;

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Ines => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Cristiano => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: false, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::PortuguesePortugal;
    }
}
