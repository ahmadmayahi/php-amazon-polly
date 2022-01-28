<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums;

enum Language: string
{
    case Arabic = 'arb';

    case Chinese = 'cmn-CN';

    case Danish = 'da-DK';

    case Dutch = 'nl-NL';

    case EnglishAustralian = 'en-AU';

    case EnglishBritish = 'en-GB';

    case EnglishIndian = 'en-IN';

    case EnglishNewZealand = 'en-NZ';

    case EnglishSouthAfrican = 'en-ZA';

    case EnglishUnitedStates = 'en-US';

    case EnglishWelsh = 'en-GB-WLS';

    case FrenchFrance = 'fr-FR';

    case FrenchCanadian = 'fr-CA';

    case German = 'de-DE';

    case Hindi = 'hi-IN';

    case Icelandic = 'is-IS';

    case Italian = 'it-IT';

    case Japanese = 'ja-JP';

    case Korean = 'ko-KR';

    case Norwegian = 'nb-NO';

    case Polish = 'pl-PL';

    case PortugueseBrazilian = 'pt-BR';

    case PortuguesePortugal = 'pt-PT';

    case Romanian = 'ro-RO';

    case Russian = 'ru-RU';

    case SpanishSpain = 'es-ES';

    case SpanishMexican = 'es-MX';

    case SpanishUnitedStates = 'es-US';

    case Swedish = 'sv-SE';

    case Turkish = 'tr-TR';

    case Welsh = 'cy-GB';

    public static function list(): array
    {
        return array_map(fn ($item) => $item->name, self::cases());
    }
}
