<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums\Voices;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Utils\VoiceDescriptionFactory;

enum Romanian implements Voice
{
    case Carmen;

    public function describe(): VoiceDescription
    {
        return VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true);
    }

    public function language(): Language
    {
        return Language::German;
    }
}
