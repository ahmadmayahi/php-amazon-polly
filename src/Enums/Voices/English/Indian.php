<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums\Voices\English;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Utils\VoiceDescriptionFactory;

enum Indian implements Voice
{

    case Aditi;

    case Raveena;

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Aditi => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true, bilingual: true),
            self::Raveena => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::EnglishIndian;
    }
}
