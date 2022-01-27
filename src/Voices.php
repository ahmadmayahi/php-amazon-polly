<?php

namespace AhmadMayahi\Polly;

use AhmadMayahi\Polly\Enums\Voices\Arabic;
use AhmadMayahi\Polly\Enums\Voices\Chinese;
use AhmadMayahi\Polly\Enums\Voices\Danish;
use AhmadMayahi\Polly\Enums\Voices\Dutch;
use AhmadMayahi\Polly\Enums\Voices\English\Australian;
use AhmadMayahi\Polly\Enums\Voices\English\British;
use AhmadMayahi\Polly\Enums\Voices\English\NewZealand;
use AhmadMayahi\Polly\Enums\Voices\English\SouthAfrican;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Enums\Voices\French\Canadian;
use AhmadMayahi\Polly\Enums\Voices\French\France;
use AhmadMayahi\Polly\Enums\Voices\German;
use AhmadMayahi\Polly\Enums\Voices\Hindi;
use AhmadMayahi\Polly\Enums\Voices\Icelandic;
use AhmadMayahi\Polly\Enums\Voices\Italian;
use AhmadMayahi\Polly\Enums\Voices\Japanese;
use AhmadMayahi\Polly\Enums\Voices\Korean;
use AhmadMayahi\Polly\Enums\Voices\Norwegian;
use AhmadMayahi\Polly\Enums\Voices\Polish;
use AhmadMayahi\Polly\Enums\Voices\Portuguese\Brazilian;
use AhmadMayahi\Polly\Enums\Voices\Portuguese\Portugal;
use AhmadMayahi\Polly\Enums\Voices\Romanian;
use AhmadMayahi\Polly\Enums\Voices\Russian;
use AhmadMayahi\Polly\Enums\Voices\Spanish\Mexican;
use AhmadMayahi\Polly\Enums\Voices\Spanish\Spain;
use AhmadMayahi\Polly\Enums\Voices\Swedish;
use AhmadMayahi\Polly\Enums\Voices\Turkish;
use AhmadMayahi\Polly\Enums\Voices\Welsh;

class Voices
{
    public static array $voices = [
        // Arabic
        'Zeina' => Arabic::Zeina,

        // Chinese
        'Zhiyu' => Chinese::Zhiyu,

        // Australian
        'Nicole' => Australian::Nicole,
        'Olivia' => Australian::Olivia,
        'Russell' => Australian::Russell,

        // British
        'Amy' => British::Amy,
        'Emma' => British::Emma,
        'Brian' => British::Brian,

        // NewZealand
        'Aria' => NewZealand::Aria,

        // South African
        'Ayanda' => SouthAfrican::Ayanda,

        // UnitedStates
        'Ivy' => UnitedStates::Ivy,
        'Joanna' => UnitedStates::Joanna,
        'Kendra' => UnitedStates::Kendra,
        'Kimberly' => UnitedStates::Kimberly,
        'Salli' => UnitedStates::Salli,
        'Joey' => UnitedStates::Joey,
        'Justin' => UnitedStates::Justin,
        'Kevin' => UnitedStates::Kevin,
        'Matthew' => UnitedStates::Matthew,

        // Welsh
        'Geraint' => Enums\Voices\English\Welsh::Geraint,

        // French (Canadian)
        'Chantal' => Canadian::Chantal,
        'Gabrielle' => Canadian::Gabrielle,

        // French (French)
        'Celine' => France::Celine,
        'Lea' => France::Lea,
        'Mathieu' => France::Mathieu,

        // Portuguese (Brazilian)
        'Camila' => Brazilian::Camila,
        'Vitoria' => Brazilian::Vitoria,
        'Ricardo' => Brazilian::Ricardo,

        // Portuguese (Portugal)
        'Ines' => Portugal::Ines,
        'Cristiano' => Portugal::Cristiano,

        // Spanish (Mexican)
        'Mia' => Mexican::Mia,

        // Spanish (Spain)
        'Conchita' => Spain::Conchita,
        'Lucia' => Spain::Lucia,
        'Enrique' => Spain::Enrique,

        // Spanish (United States)
        'Lupe' => Enums\Voices\Spanish\UnitedStates::Lupe,
        'Penelope' => Enums\Voices\Spanish\UnitedStates::Penelope,
        'Miguel' => Enums\Voices\Spanish\UnitedStates::Miguel,

        // Danish
        'Naja' => Danish::Mads,
        'Mads' => Danish::Mads,

        // Dutch
        'Lotte' => Dutch::Lotte,
        'Ruben' => Dutch::Ruben,

        // German
        'Marlene' => German::Marlene,
        'Vicki' => German::Vicki,
        'Hans' => German::Hans,

        // Hindi
        'Aditi' => Hindi::Aditi,

        // Icelandic
        'Dora' => Icelandic::Dora,
        'Karl' => Icelandic::Karl,

        // Italian
        'Carla' => Italian::Carla,
        'Bianca' => Italian::Bianca,
        'Giorgio' => Italian::Giorgio,

        // Japanese
        'Mizuki' => Japanese::Mizuki,
        'Takumi' => Japanese::Takumi,

        // Korean
        'Seoyeon' => Korean::Seoyeon,

        // Norwegian
        'Liv' => Norwegian::Liv,

        // Polish
        'Ewa' => Polish::Ewa,
        'Maja' => Polish::Maja,
        'Jacek' => Polish::Jacek,
        'Jan' => Polish::Jan,

        // Romanian
        'Carmen' => Romanian::Carmen,

        // Russian
        'Tatyana' => Russian::Tatyana,
        'Maxim' => Russian::Maxim,

        // Swedish
        'Astrid' => Swedish::Astrid,

        // Turkish
        'Filiz' => Turkish::Filiz,

        // Welsh
        'Gwyneth' => Welsh::Gwyneth,
    ];
}
