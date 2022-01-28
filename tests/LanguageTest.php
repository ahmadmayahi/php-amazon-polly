<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Enums\Language;

final class LanguageTest extends AbstractTest
{
    /**
     * @test
     * @dataProvider list
     */
    public function languageByCode(Language $language, string $code): void
    {
        $this->assertEquals($code, $language->value);
    }

    /** @test */
    public function languagesList(): void
    {
        $langs = array_map(function ($language) {
            return $language[0]->name;
        }, $this->list());

        $this->assertEquals($langs, Language::list());
    }

    public function list(): array
    {
        return [
            [Language::Arabic, 'arb'],
            [Language::Chinese, 'cmn-CN'],
            [Language::Danish, 'da-DK'],
            [Language::Dutch, 'nl-NL'],
            [Language::EnglishAustralian, 'en-AU'],
            [Language::EnglishBritish, 'en-GB'],
            [Language::EnglishIndian, 'en-IN'],
            [Language::EnglishNewZealand, 'en-NZ'],
            [Language::EnglishSouthAfrican, 'en-ZA'],
            [Language::EnglishUnitedStates, 'en-US'],
            [Language::EnglishWelsh, 'en-GB-WLS'],
            [Language::FrenchFrance, 'fr-FR'],
            [Language::FrenchCanadian, 'fr-CA'],
            [Language::German, 'de-DE'],
            [Language::Hindi, 'hi-IN'],
            [Language::Icelandic, 'is-IS'],
            [Language::Italian, 'it-IT'],
            [Language::Japanese, 'ja-JP'],
            [Language::Korean, 'ko-KR'],
            [Language::Norwegian, 'nb-NO'],
            [Language::Polish, 'pl-PL'],
            [Language::PortugueseBrazilian, 'pt-BR'],
            [Language::PortuguesePortugal, 'pt-PT'],
            [Language::Romanian, 'ro-RO'],
            [Language::Russian, 'ru-RU'],
            [Language::SpanishSpain, 'es-ES'],
            [Language::SpanishMexican, 'es-MX'],
            [Language::SpanishUnitedStates, 'es-US'],
            [Language::Swedish, 'sv-SE'],
            [Language::Turkish, 'tr-TR'],
            [Language::Welsh, 'cy-GB'],
        ];
    }
}
