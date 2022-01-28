<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices\Spanish;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Spain implements Voice
{
    case Conchita;

    case Lucia;

    case Enrique;

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Conchita => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Lucia => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true),
            self::Enrique => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: false, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::SpanishSpain;
    }
}
