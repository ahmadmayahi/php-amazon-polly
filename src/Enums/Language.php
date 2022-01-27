<?php

namespace AhmadMayahi\Polly\Enums;

enum Language
{
    case Arabic;

    case Chinese;

    case Danish;

    case Dutch;

    case German;

    case Hindi;

    case Icelandic;

    case Italian;

    case Japanese;

    case Korean;

    case Norwegian;

    case Polish;

    case Romanian;

    case Russian;

    case Swedish;

    case Turkish;

    case Welsh;

    case EnglishAustralian;

    case EnglishBritish;

    case EnglishIndian;

    case EnglishNewZealand;

    case EnglishSouthAfrican;

    case EnglishUnitedStates;

    case EnglishWelsh;

    case FrenchFrance;

    case FrenchCanadian;

    case PortugueseBrazilian;

    case PortuguesePortugal;

    case SpanishMexican;

    case SpanishSpain;

    case SpanishUnitedStates;

    public static function list(): array
    {
        return array_map(fn ($item) => $item->name, self::cases());
    }
}
