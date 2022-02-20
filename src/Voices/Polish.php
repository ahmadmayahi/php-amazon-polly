<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Voices;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Support\VoiceDescriptionFactory;

enum Polish: string implements Voice
{
    case Ewa = 'Ewa';

    case Maja = 'Maja';

    case Jacek = 'Jacek';

    case Jan = 'Jan';

    public function describe(): VoiceDescription
    {
        return match ($this) {
            self::Ewa, self::Maja => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Female, neural: false, standard: true),
            self::Jacek, self::Jan => VoiceDescriptionFactory::generate(voice: $this, gender: Gender::Male, neural: false, standard: true),
        };
    }

    public function language(): Language
    {
        return Language::Polish;
    }
}
