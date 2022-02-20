<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices\French;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Canada: string implements Voice
{
    case Chantal = 'Chantal';

    case Gabrielle = 'Gabrielle';

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Chantal => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Gabrielle => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: false),
        };
    }

    public function language(): Language
    {
        return Language::FrenchCanadian;
    }
}
