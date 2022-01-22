<?php

namespace AhmadMayahi\Polly\Tests;

use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Enums\Voices\Arabic;
use AhmadMayahi\Polly\Enums\Voices\Chinese;
use AhmadMayahi\Polly\Enums\Voices\Danish;
use AhmadMayahi\Polly\Enums\Voices\Dutch;
use AhmadMayahi\Polly\Enums\Voices\German;
use AhmadMayahi\Polly\Enums\Voices\Hindi;
use AhmadMayahi\Polly\Enums\Voices\Icelandic;
use AhmadMayahi\Polly\Enums\Voices\Italian;
use AhmadMayahi\Polly\Enums\Voices\Japanese;
use AhmadMayahi\Polly\Enums\Voices\Korean;
use AhmadMayahi\Polly\Enums\Voices\Norwegian;
use AhmadMayahi\Polly\Enums\Voices\Polish;

class VoicesTest extends AbstractTest
{
    /** @test */
    public function it_should_describe_zeina_in_arabic_language(): void
    {
        $this->assertEquals(Language::Arabic, Arabic::Zeina->language());

        $this->assertEquals(
            new VoiceDescription(name: Arabic::Zeina, gender: Gender::Female, neural: false, standard: true),
            Arabic::Zeina->describe()
        );
    }

    /** @test */
    public function it_should_describe_zhiyu_in_chinese_language(): void
    {
        $this->assertEquals(Language::Chinese, Chinese::Zhiyu->language());

        $this->assertEquals(
            new VoiceDescription(name: Chinese::Zhiyu, gender: Gender::Female, neural: false, standard: true),
            Chinese::Zhiyu->describe()
        );
    }

    /** @test */
    public function it_should_describe_naja_in_danish_language(): void
    {
        $this->assertEquals(Language::Danish, Danish::Naja->language());

        $this->assertEquals(
            new VoiceDescription(name: Danish::Naja, gender: Gender::Female, neural: false, standard: true),
            Danish::Naja->describe()
        );
    }

    /** @test */
    public function it_should_describe_mads_in_danish_language(): void
    {
        $this->assertEquals(Language::Danish, Danish::Naja->language());

        $this->assertEquals(
            new VoiceDescription(name: Danish::Mads, gender: Gender::Male, neural: false, standard: true),
            Danish::Mads->describe()
        );
    }

    /** @test */
    public function it_should_describe_lotte_in_dutch_language(): void
    {
        $this->assertEquals(Language::Dutch, Dutch::Lotte->language());

        $this->assertEquals(
            new VoiceDescription(name: Dutch::Lotte, gender: Gender::Female, neural: false, standard: true),
            Dutch::Lotte->describe()
        );
    }

    /** @test */
    public function it_should_describe_ruben_in_dutch_language(): void
    {
        $this->assertEquals(Language::Dutch, Dutch::Ruben->language());

        $this->assertEquals(
            new VoiceDescription(name: Dutch::Ruben, gender: Gender::Male, neural: false, standard: true),
            Dutch::Ruben->describe()
        );
    }

    /** @test */
    public function it_should_describe_marlene_in_german_language(): void
    {
        $this->assertEquals(Language::German, German::Marlene->language());

        $this->assertEquals(
            new VoiceDescription(name: German::Marlene, gender: Gender::Female, neural: false, standard: true),
            German::Marlene->describe()
        );
    }

    /** @test */
    public function it_should_describe_vicki_in_german_language(): void
    {
        $this->assertEquals(Language::German, German::Vicki->language());

        $this->assertEquals(
            new VoiceDescription(name: German::Vicki, gender: Gender::Female, neural: true, standard: true),
            German::Vicki->describe()
        );
    }

    /** @test */
    public function it_should_describe_hans_in_german_language(): void
    {
        $this->assertEquals(Language::German, German::Hans->language());

        $this->assertEquals(
            new VoiceDescription(name: German::Hans, gender: Gender::Male, neural: false, standard: true),
            German::Hans->describe()
        );
    }

    /** @test */
    public function it_should_describe_anditi_in_hindi_language(): void
    {
        $this->assertEquals(Language::Hindi, Hindi::Aditi->language());

        $this->assertEquals(
            new VoiceDescription(name: Hindi::Aditi, gender: Gender::Female, neural: false, standard: true, bilingual: true),
            Hindi::Aditi->describe()
        );
    }

    /** @test */
    public function it_should_describe_dora_in_icelandic_language(): void
    {
        $this->assertEquals(Language::Icelandic, Icelandic::Dora->language());

        $this->assertEquals(
            new VoiceDescription(name: Icelandic::Dora, gender: Gender::Female, neural: false, standard: true),
            Icelandic::Dora->describe()
        );
    }

    /** @test */
    public function it_should_describe_karl_in_icelandic_language(): void
    {
        $this->assertEquals(Language::Icelandic, Icelandic::Karl->language());

        $this->assertEquals(
            new VoiceDescription(name: Icelandic::Karl, gender: Gender::Male, neural: false, standard: true),
            Icelandic::Karl->describe()
        );
    }

    /** @test */
    public function it_should_describe_carla_in_italian_language(): void
    {
        $this->assertEquals(Language::Italian, Italian::Carla->language());

        $this->assertEquals(
            new VoiceDescription(name: Italian::Carla, gender: Gender::Female, neural: false, standard: true),
            Italian::Carla->describe()
        );
    }

    /** @test */
    public function it_should_describe_bianca_in_italian_language(): void
    {
        $this->assertEquals(Language::Italian, Italian::Bianca->language());

        $this->assertEquals(
            new VoiceDescription(name: Italian::Bianca, gender: Gender::Female, neural: true, standard: true),
            Italian::Bianca->describe()
        );
    }

    /** @test */
    public function it_should_describe_mizuki_in_japanese_language(): void
    {
        $this->assertEquals(Language::Japanese, Japanese::Mizuki->language());

        $this->assertEquals(
            new VoiceDescription(name: Japanese::Mizuki, gender: Gender::Female, neural: false, standard: true),
            Japanese::Mizuki->describe()
        );
    }

    /** @test */
    public function it_should_describe_takumi_in_japanese_language(): void
    {
        $this->assertEquals(Language::Japanese, Japanese::Takumi->language());

        $this->assertEquals(
            new VoiceDescription(name: Japanese::Takumi, gender: Gender::Male, neural: true, standard: true),
            Japanese::Takumi->describe()
        );
    }

    /** @test */
    public function it_should_describe_seoyeon_in_korean_language(): void
    {
        $this->assertEquals(Language::Korean, Korean::Seoyeon->language());

        $this->assertEquals(
            new VoiceDescription(name: Korean::Seoyeon, gender: Gender::Female, neural: true, standard: false),
            Korean::Seoyeon->describe()
        );
    }

    /** @test */
    public function it_should_describe_liv_in_norwegian_language(): void
    {
        $this->assertEquals(Language::Norwegian, Norwegian::Liv->language());

        $this->assertEquals(
            new VoiceDescription(name: Norwegian::Liv, gender: Gender::Female, neural: false, standard: true),
            Norwegian::Liv->describe()
        );
    }

    /** @test */
    public function it_should_describe_ewa_in_polish_language(): void
    {
        $this->assertEquals(Language::Polish, Polish::Ewa->language());

        $this->assertEquals(
            new VoiceDescription(name: Polish::Ewa, gender: Gender::Female, neural: false, standard: true),
            Polish::Ewa->describe()
        );
    }

    /** @test */
    public function it_should_describe_maja_in_polish_language(): void
    {
        $this->assertEquals(Language::Polish, Polish::Maja->language());

        $this->assertEquals(
            new VoiceDescription(name: Polish::Maja, gender: Gender::Female, neural: false, standard: true),
            Polish::Maja->describe()
        );
    }

    /** @test */
    public function it_should_describe_jacek_in_polish_language(): void
    {
        $this->assertEquals(Language::Polish, Polish::Jacek->language());

        $this->assertEquals(
            new VoiceDescription(name: Polish::Jacek, gender: Gender::Male, neural: false, standard: true),
            Polish::Jacek->describe()
        );
    }

    /** @test */
    public function it_should_describe_jan_in_polish_language(): void
    {
        $this->assertEquals(Language::Polish, Polish::Jan->language());

        $this->assertEquals(
            new VoiceDescription(name: Polish::Jan, gender: Gender::Male, neural: false, standard: true),
            Polish::Jan->describe()
        );
    }
}
