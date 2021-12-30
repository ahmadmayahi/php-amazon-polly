<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums\Voices\English;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Utils\VoiceDescriptionFactory;

enum UnitedStates implements Voice
{
    case Ivy;

    case Joanna;

    case Kendra;

    case Kimberly;

    case Salli;

    case Joey;

    case Justin;

    case Kevin;

    case Matthew;

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Ivy => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true, child: true),
            self::Joanna => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true, newscaster: true),
            self::Kendra, self::Kimberly, self::Salli => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true),
            self::Joey => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: true, standard: true),
            self::Justin => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: true, standard: true, child: true),
            self::Kevin => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: true, standard: false, child: true),
            self::Matthew => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: true, standard: true, newscaster: true),
        };
    }

    public function language(): Language
    {
        return Language::EnglishUnitedStates;
    }
}
