<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums\Voices\English;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Utils\VoiceDescriptionFactory;

enum British implements Voice
{
    case Amy;

    case Emma;

    case Brian;

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Amy => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true, newscaster: true),
            self::Emma => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true),
            self::Brian => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: true, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::EnglishBritish;
    }
}
