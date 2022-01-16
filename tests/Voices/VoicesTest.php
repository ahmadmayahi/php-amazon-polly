<?php

namespace AhmadMayahi\Polly\Tests\Voices;

use AhmadMayahi\Polly\Data\VoiceDescription;
use AhmadMayahi\Polly\Enums\Gender;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Enums\Voices\Arabic;
use AhmadMayahi\Polly\Enums\Voices\Chinese;
use AhmadMayahi\Polly\Enums\Voices\Danish;
use AhmadMayahi\Polly\Enums\Voices\Dutch;
use AhmadMayahi\Polly\Enums\Voices\German;
use AhmadMayahi\Polly\Tests\AbstractTest;

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
}
