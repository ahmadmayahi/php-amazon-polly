<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices\French;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum France: string implements Voice
{
    case Celine = 'Celine';

    case Lea = 'Lea';

    case Mathieu = 'Mathieu';

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Celine => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Lea => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true),
            self::Mathieu => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: false, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::FrenchFrance;
    }
}
