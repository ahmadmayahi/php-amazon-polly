<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices\Portuguese;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Brazil: string implements Voice
{
    case Camila = 'Camila';

    case Vitoria = 'Vitoria';

    case Ricardo = 'Ricardo';

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Camila => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: true, standard: true),
            self::Vitoria => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Ricardo => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: false, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::PortugueseBrazilian;
    }
}
