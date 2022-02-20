<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices\English;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Australian: string implements Voice
{
    case Nicole = 'Nicole';

    case Olivia = 'Olivia';

    case Russell = 'Russell';

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Nicole => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Olivia => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: false),
            self::Russell => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: false, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::EnglishAustralian;
    }
}
