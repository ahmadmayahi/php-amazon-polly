<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices\English;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum NewZealand: string implements Voice
{
    case Aria = 'Aria';

    public function describe(): VoiceDescription
    {
        return VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: false);
    }

    public function language(): Language
    {
        return Language::EnglishNewZealand;
    }
}
