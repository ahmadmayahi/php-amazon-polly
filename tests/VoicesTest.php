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
use AhmadMayahi\Polly\Voices\French\Canadian;
use AhmadMayahi\Polly\Voices\French\France;
use AhmadMayahi\Polly\Voices\German;
use AhmadMayahi\Polly\Voices\Hindi;
use AhmadMayahi\Polly\Voices\Icelandic;
use AhmadMayahi\Polly\Voices\Italian;

class VoicesTest extends AbstractTest
{
    /**
     * @test
     * @dataProvider provider
     */
    public function tryVoiceId(Language $language, Voice $voiceId, Gender $gender, bool $neural = false, bool $standard = true, bool $bilingual = false, bool $newsCaster = false, bool $child = false)
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
            [Language::FrenchCanadian, Canadian::Chantal, Gender::Female],
            [Language::FrenchCanadian, Canadian::Gabrielle, Gender::Female, true, false],

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
            [Language::Italian, Italian::Bianca, Gender::Female, true, true],
            [Language::Italian, Italian::Giorgio, Gender::Male],


            // Japanese

        ];
    }
}
