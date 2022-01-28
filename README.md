
<div align="center">
  <img style="width:300px" src="art/logo.png" alt="PHP Google Vision" />

<hr>

[![Tests](https://github.com/ahmadmayahi/php-amazon-polly/actions/workflows/run-tests.yml/badge.svg)](https://github.com/ahmadmayahi/php-amazon-polly/actions/workflows/run-tests.yml)
[![Check & fix styling](https://github.com/ahmadmayahi/php-amazon-polly/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/ahmadmayahi/php-amazon-polly/actions/workflows/php-cs-fixer.yml)
[![Test Coverage](https://codecov.io/gh/ahmadmayahi/php-amazon-polly/branch/main/graph/badge.svg?token=hayMyn8tLI)](https://codecov.io/gh/ahmadmayahi/php-amazon-polly)

<hr/>

</div>

**Requires PHP 8.1+**

For feedback, please [contact me](https://form.jotform.com/201892949858375).

**PHP Amazon Polly** is an easy and elegant wrapper around [Amazon Polly](https://aws.amazon.com/polly/), a service that turns text into lifelike speech.

# Contents

- [Installation](#installation)
- [Usage](#usage)
- [Speech Marks](#speech-marks)
- [SSml](#ssml)
- [Standard vs Neural Voices](#standard-vs-neural-voices)
- [Voice Methods](#voice-methods)
- [Voice Enums](#voice-enums)
  - [Describe Voice](#describe-voice)

## Installation

You can install the package via composer:

```bash
composer require ahmadmayahi/php-amazon-polly
```

## Usage

First you need to configure the client:

```php
use AhmadMayahi\Polly\Config;
use AhmadMayahi\Polly\Polly;

$config = (new Config())
    ->setKey('AWS_KEY')
    ->setSecret('AWS_SECRET')
    ->setRegion('eu-west-1'); // default is: us-east-1

$polly = Polly::init($config);
```

Save as MP3 file:

```php
use AhmadMayahi\Polly\Voices\English\UnitedStates;

$speechFile = $speech
    // Desired voice
    ->voiceId(UnitedStates::Joanna)
    
    // Default is MP3.
    // Available options: asMp3(), asOgg(), asPcm(), asJson()
    ->asOgg()
    
    // Desired Text
    ->text('Hello World')
 
    // Convert and return the object
    ->convert();
```

The `convert` method returns an object of type `AhmadMayahi\Polly\Data\SpeechFile` which has three properties:

* `file`: the output file as `SplFileObject`.
* `speechMarks` (if any).
* `took`: how long did it take to convert the text.

By default, the `convert` method saves the file into the default temp. directory; If you want to save the file into a specific directory then you might need to provide the file path as param:

```php
convert('/path/to/desire/file/voice.mp3');
```

The `voiceId()` also accepts a string:
```php
voiceId('Joanna')
```

## Speech Marks

You may also request the [Speech Mark Types](https://docs.aws.amazon.com/polly/latest/dg/speechmarks.html) as follows:

```php
use AhmadMayahi\Polly\Enums\SpeechMarkType;use AhmadMayahi\Polly\Voices\English\UnitedStates;

$speechFile = $speech
    ->voiceId(UnitedStates::Joanna)
    ->text('Hello World')
    ->withSpeechMarks(SpeechMarkType::Word, SpeechMarkType::Sentence)
    ->convert();
```

> The `speechMarks()` method issues another request to get the speech marks.

```php
Array
(
    [0] => AhmadMayahi\Polly\Data\SpeechMark Object
        (
            [time] => 0
            [type] => AhmadMayahi\Polly\Enums\SpeechMarkType Enum:string
                (
                    [name] => Sentence
                    [value] => sentence
                )

            [start] => 7
            [end] => 18
            [value] => Hello World
        )

    [1] => AhmadMayahi\Polly\Data\SpeechMark Object
        (
            [time] => 6
            [type] => AhmadMayahi\Polly\Enums\SpeechMarkType Enum:string
                (
                    [name] => Word
                    [value] => word
                )

            [start] => 7
            [end] => 12
            [value] => Hello
        )

    [2] => AhmadMayahi\Polly\Data\SpeechMark Object
        (
            [time] => 273
            [type] => AhmadMayahi\Polly\Enums\SpeechMarkType Enum:string
                (
                    [name] => Word
                    [value] => word
                )

            [start] => 13
            [end] => 18
            [value] => World
        )
)
```

## SSML

If the given text starts with `<spaek>` then the `SSML` will be used while synthesizing:

```php
use AhmadMayahi\Polly\Voices\English\UnitedStates;

$text = <<<EOL
<speak>
     He was caught up in the game.<break time="1s"/> In the middle of the 
     10/3/2014 <sub alias="World Wide Web Consortium">W3C</sub> meeting, 
     he shouted, "Nice job!" quite loudly. When his boss stared at him, he repeated 
     <amazon:effect name="whispered">"Nice job,"</amazon:effect> in a 
     whisper.
</speak>
EOL;

$speechFile = $speech
    ->voiceId(UnitedStates::Ivy)
    ->text($text)
    ->convert();
```

> [Read more about SSML](https://docs.aws.amazon.com/polly/latest/dg/ssml.html).

## Standard vs Neural Voices

[Amazon Polly](https://docs.aws.amazon.com/polly/) provides two voice systems `Standard` and `Neural`.

The `Neural` system can produce higher quality voices than the standard voices.

By default, this package will always use the `Standard` voice if available, however, some voices such as `Olivia` (English Australian) is only available as `Neural`.

You may use the `neuralVoice()` or `standardVoice()` methods as follows:

```php
use AhmadMayahi\Polly\Voices\English\UnitedStates;

$speechFile = $speech
    ->voiceId(UnitedStates::Kendra)
    ->text('Hello World')
    ->neuralVoice()
    ->convert();
```

> Not all the voices support the `nueral` system, for more information please visit [Voices in Amazon Polly](https://docs.aws.amazon.com/polly/latest/dg/voicelist.html) page.

## Convenient Voice Methods

PHP Amazon Polly provides a convenient way to get the appropriate voice id without the need to inspect the documentation.

For example, if you want to use `Joanna` you may use `englishUnitedStatesJoanna()` method as follows:

```php

$speechFile = $speech
    ->englishUnitedStatesJoanna($neural = true)
    ->text('Hello World')
    ->convert();
```

As you might have noticed, `Joanna` accepts an optional param `$neural`, set it to `true` if you want neural voice.

Here is the full list of voices with their equivalent method:

 | Voice                       | Method                                     |
|-----------------------------|--------------------------------------------|
| Arabic (Zeina)              | `arabicZeina()`                            |
| Chinese (Zhiyu)             | `chineseZhiyu()`                           |
| Danish (Naja)               | `danishNaja()`                             |
| Danish (Mads)               | `danishMads()`                             |
| Dutch (Lotte)               | `dutchLotte()`                             |
| Dutch (Ruben)               | `dutchRuben()`                             |
| English Australian (Nicole) | `englishAustralianNicole()`                |
| English Australian (Olivia) | `englishAustralianOlivia($neural = false)` |
| English Australian (Russel) | `englishAustralianRussel()`                |
| English British (Amy)       | `englishBritishAmy($neural = false)`       |

## Voice Enums

All the [Amazon Polly Voices](https://docs.aws.amazon.com/polly/latest/dg/voicelist.html) are supported as enums:

| Language                | Enum                                                  |
|-------------------------|-------------------------------------------------------|
| Arabic                  | `AhmadMayahi\Polly\Enums\Voices\Arabic`               |
| Chinese, Mandarin       | `AhmadMayahi\Polly\Enums\Voices\Chinese`              |
| Danish                  | `AhmadMayahi\Polly\Enums\Voices\Danish`               |
| Dutch                   | `AhmadMayahi\Polly\Enums\Voices\Dutch`                |
| English (Australian)    | `AhmadMayahi\Polly\Enums\Voices\English\Australian`   |
| English (British)       | `AhmadMayahi\Polly\Enums\Voices\English\British`      |
| English (Indian)        | `AhmadMayahi\Polly\Enums\Voices\English\Indian`       |
| English (New Zealand)   | `AhmadMayahi\Polly\Enums\Voices\English\NewZealand`   |
| English (South African) | `AhmadMayahi\Polly\Enums\Voices\English\SouthAfrican` |
| English (United States) | `AhmadMayahi\Polly\Enums\Voices\English\UnitedStates` |
| French                  | `AhmadMayahi\Polly\Enums\Voices\French\French`        |
| French (Canadian)       | `AhmadMayahi\Polly\Enums\Voices\French\Canadian`      |
| German                  | `AhmadMayahi\Polly\Enums\Voices\German`               |
| Hindi                   | `AhmadMayahi\Polly\Enums\Voices\Hindi`                |
| Icelandic               | `AhmadMayahi\Polly\Enums\Voices\Icelandic`            |
| Italian                 | `AhmadMayahi\Polly\Enums\Voices\Italian`              |
| Japanese                | `AhmadMayahi\Polly\Enums\Voices\Japanese`             |
| Korean                  | `AhmadMayahi\Polly\Enums\Voices\Korean`               |
| Portuguese (Brazilian)  | `AhmadMayahi\Polly\Enums\Voices\Portuguese\Brazilian` |
| Portuguese (Portugal)   | `AhmadMayahi\Polly\Enums\Voices\Portuguese\Portugal`  |
| Romanian                | `AhmadMayahi\Polly\Enums\Voices\Romanian`             |
| Russian                 | `AhmadMayahi\Polly\Enums\Voices\Russian`              |
| Spanish (Mexican)       | `AhmadMayahi\Polly\Enums\Voices\Spanish\Mexican`      |
| Spanish (Spain)         | `AhmadMayahi\Polly\Enums\Voices\Spanish\Spain`        |
| Spanish (United States) | `AhmadMayahi\Polly\Enums\Voices\Spanish\UnitedStates` |
| Swedish                 | `AhmadMayahi\Polly\Enums\Voices\Swedish`              |
| Turkish                 | `AhmadMayahi\Polly\Enums\Voices\Turkish`              |
| Welsh                   | `AhmadMayahi\Polly\Enums\Voices\Welsh`                |

For example, if you want to get `Nicole` from English (Australian):

```php
use AhmadMayahi\Polly\Voices\English\Australian;

Australian::Nicole;
```

### Describe Voice

You can also describe the voice using the `describe` method as follows:

```php
use AhmadMayahi\Polly\Voices\English\Australian;

Australian::Nicole->describe();
```

The `describe` method returns an object of type `AhmadMayahi\Polly\Data\DescribeVoice` with the following properties:

* `gender`: Determines the voice's gender. 
* `neural`: Is it Neural Voice?
* `standard`: Is it Standard Voice?
* `bilingual`: Is it bilingual? [Read more](https://docs.aws.amazon.com/polly/latest/dg/bilingual-voices.html).
* `newscaster`: Does it do a newscaster speaking style? [Read more](https://docs.aws.amazon.com/polly/latest/dg/ntts-speakingstyles.html)
* `child`: Child speaker?

> According to Amazon Polly documentation, Aditi (Hindi) she's the only one who speaks both Indian English (en-IN) and Hindi (hi-IN) fluently. 

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Ahmad Mayahi](https://github.com/ahmadmayahi)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
