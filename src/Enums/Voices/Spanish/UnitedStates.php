<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums\Voices\Spanish;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Utils\VoiceDescriptionFactory;

enum UnitedStates implements Voice
{
    case Lupe;

    case Penelope;

    case Miguel;

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Lupe => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true, newscaster: true),
            self::Penelope => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Miguel => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: false, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::SpanishUnitedStates;
    }
}
