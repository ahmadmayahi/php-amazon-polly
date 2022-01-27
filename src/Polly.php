<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly;

use AhmadMayahi\Polly\Contracts\Voice;
use AhmadMayahi\Polly\Data\SpeechFile;
use AhmadMayahi\Polly\Enums\Language;
use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMark;
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\VoiceType;
use AhmadMayahi\Polly\Exceptions\PollyException;
use AhmadMayahi\Polly\Utils\AbstractClient;
use Aws\Result;
use Generator;
use GuzzleHttp\Psr7\Stream;
use Throwable;

/**
 * @method self arabicZeina()
 * @method self chineseZhiyu()
 * @method self danishNaja()
 * @method self danishMads()
 * @method self dutchLotte()
 * @method self dutchRuben()
 * @method self englishAustralianNicole()
 * @method self englishAustralianOlivia($neural = false)
 * @method self englishAustralianRussell()
 * @method self englishBritishAmy($neural = false)
 * @method self englishBritishEmma($neural = false)
 * @method self englishBritishBrian($neural = false)
 * @method self englishIndianAditi()
 * @method self englishIndianRaveena()
 * @method self englishNewZealandAria()
 * @method self englishSouthAfricanAyanda()
 * @method self englishUnitedStatesIvy($neural = false)
 * @method self englishUnitedStatesJoanna($neural = false)
 * @method self englishUnitedStatesKendra($neural = false)
 * @method self englishUnitedStatesKimberly($neural = false)
 * @method self englishUnitedStatesSalli($neural = false)
 * @method self englishUnitedStatesJoey($neural = false)
 * @method self englishUnitedStatesJustin($neural = false)
 * @method self englishUnitedStatesKevin($neural = false)
 * @method self englishUnitedStatesMatthew($neural = false)
 * @method self englishWelshGeraint()
 * @method self frenchCanadianChantal()
 * @method self frenchCanadianGabrielle($neural = false)
 * @method self frenchFranceCeline()
 * @method self frenchFranceLea($neural = false)
 * @method self portugueseBrazilianCamila($neural = false)
 * @method self portugueseBrazilianVictoria()
 * @method self portugueseBrazilianRicardo()
 * @method self portuguesePortugalInes()
 * @method self portuguesePortugalCristiano()
 * @method self spanishMexicanMia()
 * @method self spanishSpainConchita()
 * @method self spanishSpainLucia($neural = false)
 * @method self spanishSpainEnrique()
 * @method self spanishUnitedStatesLupe()
 * @method self spanishUnitedStatesPenelope($neural = false)
 * @method self spanishUnitedStatesMiguel()
 * @method self germanMarlene()
 * @method self germanVicki($neural = true)
 * @method self hindiAditi()
 * @method self icelandicDora()
 * @method self icelandicKarl()
 * @method self italianCarla()
 * @method self italianBianca($neural = true)
 * @method self italianGiorgio()
 * @method self japaneseMizuki()
 * @method self japaneseTakumi($neural = true)
 * @method self koreanSeoyeon($neural = true)
 * @method self norwegianLiv()
 * @method self polishEwa()
 * @method self polishMaja()
 * @method self polishJacek()
 * @method self polishJan()
 * @method self romanianCarmen()
 * @method self russianTatyana()
 * @method self russianMaxim()
 * @method self turkishFiliz()
 * @method self welshGwyneth()
 */
class Polly extends AbstractClient
{
    private ?Voice $voice = null;

    private OutputFormat $outputFormat = OutputFormat::Mp3;

    private TextType $textType = TextType::Text;

    private string $text = '';

    private array $speechMarks = [];

    private VoiceType $voiceType = VoiceType::Auto;

    public function synthesize(): Result
    {
        $this->ensureItCanSynthesize();

        try {
            return $this->client()->synthesizeSpeech($this->speechConfig());
        } catch (Throwable $exception) {
            throw new PollyException($exception->getMessage());
        }
    }

    public function getStream(): Stream
    {
        return $this->synthesize()->get('AudioStream');
    }

    public function getStreamContents(): string
    {
        return $this->getStream()->getContents();
    }

    public function convert(string $path = null): SpeechFile
    {
        $path ??= $this->fileSystem->getTempFileName();

        $speechMarks = null;
        $file = null;

        if ($this->speechMarks) {
            $speechMarks = iterator_to_array($this->generateSpeechMarks(...$this->speechMarks));
        }

        if ($this->outputFormat !== OutputFormat::Json) {
            $file = $this->fileSystem->save($path, $this->getStreamContents());
        }

        return new SpeechFile(
            $file,
            $speechMarks,
            $this->measurement->finish(),
        );
    }

    public function asMp3(): static
    {
        $this->outputFormat = OutputFormat::Mp3;

        return $this;
    }

    public function asOgg(): static
    {
        $this->outputFormat = OutputFormat::Ogg;

        return $this;
    }

    public function asPcm(): static
    {
        $this->outputFormat = OutputFormat::Pcm;

        return $this;
    }

    public function asJson(): static
    {
        $this->outputFormat = OutputFormat::Json;

        return $this;
    }

    public function textType(TextType $textType): static
    {
        $this->textType = $textType;

        return $this;
    }

    private function generateSpeechMarks(SpeechMark ...$speechMarkType): Generator
    {
        $speechMarksList = (new self($this->config, $this->client, $this->fileSystem, $this->measurement))
            ->voiceId($this->voice)
            ->asJson()
            ->text($this->text)
            ->textType($this->textType)
            ->withSpeechMarks(...$speechMarkType)
            ->getStreamContents();

        $list = array_filter(explode(PHP_EOL, $speechMarksList));

        foreach ($list as $item) {
            $item = trim($item);

            if (! $item) {
                continue ;
            }

            yield json_decode($item);
        }
    }

    public function voiceId(Voice|string $voice): static
    {
        if (is_string($voice)) {
            $voice = Voices::$voices[ucfirst($voice)];
        }

        $this->voice = $voice;

        return $this;
    }

    public function text(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function ssml(): static
    {
        $this->textType = TextType::Ssml;

        return $this;
    }

    public function neuralVoice(): static
    {
        $this->voiceType = VoiceType::Neural;

        return $this;
    }

    public function standardVoice(): static
    {
        $this->voiceType = VoiceType::Standard;

        return $this;
    }

    public function withSpeechMarks(SpeechMark ...$speechMarkType): static
    {
        $this->speechMarks = $speechMarkType;

        return $this;
    }

    protected function speechConfig(): array
    {
        $list = [
            'Text' => $this->text,
            'OutputFormat' => $this->outputFormat->value,
            'TextType' => $this->textType->value,
            'VoiceId' => $this->voice->name,
            'Engine' => $this->getEngine(),
        ];

        if ($this->speechMarks && $this->outputFormat === OutputFormat::Json) {
            $list['SpeechMarkTypes'] = array_map(fn ($item) => $item->value, $this->speechMarks);
        }

        return $list;
    }

    protected function getEngine(): string
    {
        if ($this->voiceType == VoiceType::Auto) {
            if ($this->voice->describe()->standard === true) {
                return 'standard';
            }

            return 'neural';
        }

        $voiceDescription = $this->voice->describe();

        if ($voiceDescription->standard && $this->voiceType === VoiceType::Standard) {
            return 'standard';
        }

        if ($voiceDescription->neural && $this->voiceType === VoiceType::Neural) {
            return 'neural';
        }

        throw new PollyException('The given voice type '.$this->voiceType->value.' is not supported for '.$this->voice->value);
    }

    private function ensureItCanSynthesize(): void
    {
        if (is_null($this->voice)) {
            throw new PollyException('No voice was given!');
        }

        if (empty($this->text)) {
            throw new PollyException('No text to synthesize!');
        }
    }

    public function __call(string $name, array $arguments): static
    {
        $recognizedVoice = $this->recognizedVoice($name);

        if (! $recognizedVoice) {
            throw new PollyException('Cannot recognize voice '.$name);
        }

        $voices = Voices::$voices;

        if (! isset($voices[$recognizedVoice])) {
            throw new PollyException($recognizedVoice . ' is not a valid voice!');
        }

        $this->voice = $voices[$recognizedVoice];

        if (isset($arguments[0]) && $arguments[0] === true && $this->voice->describe()->neural === true) {
            $this->voiceType = VoiceType::Neural;
        }

        return $this;
    }

    protected function recognizedVoice($name): ?string
    {
        $name = ucfirst($name);

        $languages = Language::list();

        $recognizedVoice = array_filter(array_map(function ($language) use ($name) {
            if (str_starts_with($name, $language)) {
                return ucfirst(substr(ucfirst($name), strlen($language)));
            }

            return null;
        }, $languages));

        return $recognizedVoice ? $recognizedVoice[array_key_first($recognizedVoice)] : null;
    }
}
