<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Norwegian: string implements Voice
{
    case Liv = 'Liv';

    public function describe(): VoiceDescription
    {
        return VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true);
    }

    public function language(): Language
    {
        return Language::Norwegian;
    }
}
