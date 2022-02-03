<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
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
use Closure;

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
        'Naja' => Danish::Naja,
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

    protected array $criteria = [];

    public static function listing(): array
    {
        $list = static::$voices;

        ksort($list);

        return static::$voices;
    }

    public static function names(): array
    {
        return array_keys(static::listing());
    }

    public static function namesWithLanguages(): array
    {
        $list = static::listing();

        array_walk($list, function (Voice &$item, string $name) {
            $item = $item->language();
        });

        return $list;
    }

    public static function enumFromString(string $voiceId): ?Voice
    {
        $voiceId = ucfirst(strtolower($voiceId));

        if (false === array_key_exists($voiceId, static::$voices)) {
            return null;
        }

        return static::$voices[$voiceId];
    }

    public static function find(): static
    {
        return new static();
    }

    public function byLanguage(Language $language): static
    {
        return $this->applyFilter(fn (Voice $item) => $item->language() == $language);
    }

    public function neural(): static
    {
        return $this->applyFilter(fn (Voice $item) => $item->describe()->neural);
    }

    public function standard(): static
    {
        return $this->applyFilter(fn (Voice $item) => $item->describe()->standard);
    }

    public function bilingual(): static
    {
        return $this->applyFilter(fn (Voice $item) => $item->describe()->bilingual);
    }

    public function newscaster(): static
    {
        return $this->applyFilter(fn (Voice $item) => $item->describe()->newscaster);
    }

    public function child(): static
    {
        return $this->applyFilter(fn (Voice $item) => $item->describe()->child);
    }

    public function male(): static
    {
        return $this->applyFilter(fn (Voice $item) => $item->describe()->gender == Gender::Male);
    }

    public function female(): static
    {
        return $this->applyFilter(fn (Voice $item) => $item->describe()->gender == Gender::Female);
    }

    public function get(): array
    {
        return $this->criteria;
    }

    protected function applyFilter(Closure $closure): static
    {
        $this->criteria = array_filter($this->criteria ?: static::listing(), fn (Voice $item) => $closure($item));

        return $this;
    }
}
