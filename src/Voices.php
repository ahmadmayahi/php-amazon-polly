<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly;

use AhmadMayahi\Polly\Voices\Arabic;
use AhmadMayahi\Polly\Voices\Chinese;
use AhmadMayahi\Polly\Voices\Danish;
use AhmadMayahi\Polly\Voices\Dutch;
use AhmadMayahi\Polly\Voices\English\Australian;
use AhmadMayahi\Polly\Voices\English\British;
use AhmadMayahi\Polly\Voices\English\NewZealand;
use AhmadMayahi\Polly\Voices\English\SouthAfrican;
use AhmadMayahi\Polly\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Voices\French\Canada;
use AhmadMayahi\Polly\Voices\French\France;
use AhmadMayahi\Polly\Voices\German;
use AhmadMayahi\Polly\Voices\Hindi;
use AhmadMayahi\Polly\Voices\Icelandic;
use AhmadMayahi\Polly\Voices\Italian;
use AhmadMayahi\Polly\Voices\Japanese;
use AhmadMayahi\Polly\Voices\Korean;
use AhmadMayahi\Polly\Voices\Norwegian;
use AhmadMayahi\Polly\Voices\Polish;
use AhmadMayahi\Polly\Voices\Portuguese\Brazil;
use AhmadMayahi\Polly\Voices\Portuguese\Portugal;
use AhmadMayahi\Polly\Voices\Romanian;
use AhmadMayahi\Polly\Voices\Russian;
use AhmadMayahi\Polly\Voices\Spanish\Mexico;
use AhmadMayahi\Polly\Voices\Spanish\Spain;
use AhmadMayahi\Polly\Voices\Swedish;
use AhmadMayahi\Polly\Voices\Turkish;
use AhmadMayahi\Polly\Voices\Welsh;

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
        'Geraint' => Voices\English\Welsh::Geraint,

        // French (Canadian)
        'Chantal' => Canada::Chantal,
        'Gabrielle' => Canada::Gabrielle,

        // French (French)
        'Celine' => France::Celine,
        'Lea' => France::Lea,
        'Mathieu' => France::Mathieu,

        // Portuguese (Brazilian)
        'Camila' => Brazil::Camila,
        'Vitoria' => Brazil::Vitoria,
        'Ricardo' => Brazil::Ricardo,

        // Portuguese (Portugal)
        'Ines' => Portugal::Ines,
        'Cristiano' => Portugal::Cristiano,

        // Spanish (Mexican)
        'Mia' => Mexico::Mia,

        // Spanish (Spain)
        'Conchita' => Spain::Conchita,
        'Lucia' => Spain::Lucia,
        'Enrique' => Spain::Enrique,

        // Spanish (United States)
        'Lupe' => Voices\Spanish\UnitedStates::Lupe,
        'Penelope' => Voices\Spanish\UnitedStates::Penelope,
        'Miguel' => Voices\Spanish\UnitedStates::Miguel,

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
