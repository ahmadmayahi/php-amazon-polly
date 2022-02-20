<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices\English;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum UnitedStates: string implements Voice
{
    case Ivy = 'Ivy';

    case Joanna = 'Joanna';

    case Kendra = 'Kendra';

    case Kimberly = 'Kimberly';

    case Salli = 'Salli';

    case Joey = 'Joey';

    case Justin = 'Justin';

    case Kevin = 'Kevin';

    case Matthew = 'Matthew';

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
