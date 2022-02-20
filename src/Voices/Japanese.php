<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Japanese: string implements Voice
{
    case Mizuki = 'Mizuki';

    case Takumi = 'Takumi';

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Mizuki => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Takumi => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: true, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::Japanese;
    }
}
