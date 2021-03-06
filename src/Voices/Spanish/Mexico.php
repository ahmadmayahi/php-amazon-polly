<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices\Spanish;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Mexico: string implements Voice
{
    case Mia = 'Mia';

    public function describe(): VoiceDescription
    {
        return VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true);
    }

    public function language(): Language
    {
        return Language::SpanishMexican;
    }
}
