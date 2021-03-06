<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Korean: string implements Voice
{
    case Seoyeon = 'Seoyeon';

    public function describe(): VoiceDescription
    {
        return VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true);
    }

    public function language(): Language
    {
        return Language::Korean;
    }
}
