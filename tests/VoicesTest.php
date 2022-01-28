<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Voices\Arabic;
use AhmadMayahi\Polly\Voices\Chinese;
use AhmadMayahi\Polly\Voices\Danish;
use AhmadMayahi\Polly\Voices\Dutch;
use AhmadMayahi\Polly\Voices\English\Australian;
use AhmadMayahi\Polly\Voices\English\British;
use AhmadMayahi\Polly\Voices\English\Indian;
use AhmadMayahi\Polly\Voices\English\NewZealand;
use AhmadMayahi\Polly\Voices\English\SouthAfrican;
use AhmadMayahi\Polly\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Voices\English\Welsh;
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
use AhmadMayahi\Polly\Voices\Spanish\UnitedStates as UnitedStatesSpanish;
use AhmadMayahi\Polly\Voices\Swedish;
use AhmadMayahi\Polly\Voices\Turkish;

class VoicesTest extends AbstractTest
{
    /**
     * @test
     * @dataProvider provider
     */
    public function voice(Language $language, Voice $voiceId, Gender $gender, bool $neural = false, bool $standard = true, bool $bilingual = false, bool $newsCaster = false, bool $child = false)
    {
        $this->assertEquals($language, $voiceId->language());

        $this->assertEquals(
            new VoiceDescription(name: $voiceId, gender: $gender, neural: $neural, standard: $standard, bilingual:  $bilingual, newscaster: $newsCaster, child: $child),
            $voiceId->describe()
        );
    }

    public function provider(): array
    {
        return
        [
            [Language::Arabic, Arabic::Zeina, Gender::Female],
            [Language::Chinese, Chinese::Zhiyu, Gender::Female],
            [Language::Danish, Danish::Naja, Gender::Female],
            [Language::Danish, Danish::Mads, Gender::Male],
            [Language::Dutch, Dutch::Lotte, Gender::Female],
            [Language::Dutch, Dutch::Ruben, Gender::Male],
            [Language::EnglishAustralian, Australian::Nicole, Gender::Female],
            [Language::EnglishAustralian, Australian::Olivia, Gender::Female, true, false],
            [Language::EnglishAustralian, Australian::Russell, Gender::Male],
            [Language::EnglishBritish, British::Amy, Gender::Female, true, true, false, true],
            [Language::EnglishBritish, British::Emma, Gender::Female, true],
            [Language::EnglishBritish, British::Brian, Gender::Male, true],
            [Language::EnglishIndian, Indian::Aditi, Gender::Female, false, true, true, false],
            [Language::EnglishIndian, Indian::Raveena, Gender::Female],
            [Language::EnglishNewZealand, NewZealand::Aria, Gender::Female, true, false],
            [Language::EnglishSouthAfrican, SouthAfrican::Ayanda, Gender::Female, true, false],

            // United States
            [
                Language::EnglishUnitedStates,
                UnitedStates::Ivy,
                Gender::Female,
                true,
                true,
                false,
                false,
                true,
            ],
            [
                'language' => Language::EnglishUnitedStates,
                'voiceId' => UnitedStates::Joanna,
                'gender' => Gender::Female,
                'neural' => true,
                'standard' => true,
                'bilingual ' => false,
                'newscaster ' => true,
            ],
            [
                'language' => Language::EnglishUnitedStates,
                'voiceId' => UnitedStates::Kendra,
                'gender' => Gender::Female,
                'neural' => true,
                'standard' => true,
            ],
            [
                'language' => Language::EnglishUnitedStates,
                'voiceId' => UnitedStates::Kimberly,
                'gender' => Gender::Female,
                'neural' => true,
                'standard' => true,
            ],
            [
                'language' => Language::EnglishUnitedStates,
                'voiceId' => UnitedStates::Salli,
                'gender' => Gender::Female,
                'neural' => true,
                'standard' => true,
            ],
            [
                'language' => Language::EnglishUnitedStates,
                'voiceId' => UnitedStates::Joey,
                'gender' => Gender::Male,
                'neural' => true,
                'standard' => true,
            ],
            [
                'language' => Language::EnglishUnitedStates,
                'voiceId' => UnitedStates::Justin,
                'gender' => Gender::Male,
                'neural' => true,
                'standard' => true,
                'bilingual ' => false,
                'newscaster ' => false,
                'child' => true,
            ],
            [
                'language' => Language::EnglishUnitedStates,
                'voiceId' => UnitedStates::Kevin,
                'gender' => Gender::Male,
                'neural' => true,
                'standard' => false,
                'bilingual ' => false,
                'newscaster ' => false,
                'child' => true,
            ],
            [
                'language' => Language::EnglishUnitedStates,
                'voiceId' => UnitedStates::Matthew,
                'gender' => Gender::Male,
                'neural' => true,
                'standard' => true,
                'bilingual ' => false,
                'newscaster ' => true,
            ],

            // English (Welsh)
            [Language::EnglishWelsh, Welsh::Geraint, Gender::Male],

            // French (France)
            [Language::FrenchFrance, France::Celine, Gender::Female],
            [Language::FrenchFrance, France::Lea, Gender::Female, true, true],
            [Language::FrenchFrance, France::Mathieu, Gender::Male],

            // French (Canadian)
            [Language::FrenchCanadian, Canada::Chantal, Gender::Female],
            [Language::FrenchCanadian, Canada::Gabrielle, Gender::Female, true, false],

            // German
            [Language::German, German::Marlene, Gender::Female],
            [Language::German, German::Vicki, Gender::Female, true, true],
            [Language::German, German::Hans, Gender::Male, false, true],

            // Hindi
            [
                'language' => Language::Hindi,
                'voiceId' => Hindi::Aditi,
                'gender' => Gender::Female,
                'neural' => false,
                'standard' => true,
                'bilingual ' => true,
            ],

            // Icelandic
            [Language::Icelandic, Icelandic::Dora, Gender::Female],
            [Language::Icelandic, Icelandic::Karl, Gender::Male],

            // Italian
            [Language::Italian, Italian::Carla, Gender::Female],
            [Language::Italian, Italian::Bianca, Gender::Female, true],
            [Language::Italian, Italian::Giorgio, Gender::Male],


            // Japanese
            [Language::Japanese, Japanese::Mizuki, Gender::Female],
            [Language::Japanese, Japanese::Takumi, Gender::Male, true],

            // Korean
            [Language::Korean, Korean::Seoyeon, Gender::Female, true],

            // Norwegian
            [Language::Norwegian, Norwegian::Liv, Gender::Female],

            // Polish
            [Language::Polish, Polish::Ewa, Gender::Female],
            [Language::Polish, Polish::Maja, Gender::Female],
            [Language::Polish, Polish::Jacek, Gender::Male],
            [Language::Polish, Polish::Jan, Gender::Male],

            // Portuguese (Brazilian)
            [Language::PortugueseBrazilian, Brazil::Camila, Gender::Female, true],
            [Language::PortugueseBrazilian, Brazil::Vitoria, Gender::Female],
            [Language::PortugueseBrazilian, Brazil::Ricardo, Gender::Male],

            // Portuguese (Portugal)
            [Language::PortuguesePortugal, Portugal::Ines, Gender::Female],
            [Language::PortuguesePortugal, Portugal::Cristiano, Gender::Male],

            // Romanian
            [Language::Romanian, Romanian::Carmen, Gender::Female],

            // Russian
            [Language::Russian, Russian::Tatyana, Gender::Female],
            [Language::Russian, Russian::Maxim, Gender::Male],

            // Spanish (Spain)
            [Language::SpanishSpain, Spain::Conchita, Gender::Female],
            [Language::SpanishSpain, Spain::Lucia, Gender::Female, true],
            [Language::SpanishSpain, Spain::Enrique, Gender::Male],

            // Spanish (Mexican)
            [Language::SpanishMexican, Mexico::Mia, Gender::Female],

            // Spanish (United States)
            [Language::SpanishUnitedStates, UnitedStatesSpanish::Lupe, Gender::Female, true, true, false, true],
            [Language::SpanishUnitedStates, UnitedStatesSpanish::Penelope, Gender::Female],
            [Language::SpanishUnitedStates, UnitedStatesSpanish::Miguel, Gender::Male],

            // Swedish
            [Language::Swedish, Swedish::Astrid, Gender::Female],

            // Turkish
            [Language::Turkish, Turkish::Filiz, Gender::Female],
        ];
    }
}
