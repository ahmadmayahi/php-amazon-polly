
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
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Enums\OutputFormat;

$speechFile = $speech
    // All Amazon voices are supported
    ->voiceId(UnitedStates::Joanna)
    
    // Available options: asMp3(), asOgg(), asPcm(), asJson()
    ->asMp3()
    
    // Desired Text
    ->text('Hello World')
    
    // Optional: Use SSML instead of plain text
    ->ssml()
    
    // Returns an object of type `AhmadMayahi\Polly\Data\SpeechFile`.
    ->convert();
```

The `convert` method returns an object of type `AhmadMayahi\Polly\Data\SpeechFile` which has three properties:

* `file`: the output file in `SplFileObject`.
* `speechMarks` (if any).
* `took`: how long did it take to convert the text.

By default, the `convert` method saves the file into the default temp. directory; If you want to save the file into a specific directory then you might need to provide the file path as param:

```php
->convert('/path/to/desire/file/voice.mp3');
```

The `voiceId()` also accept a string:
```php
->voiceId('Joanna')
```

## Speech Marks

You may also request the [Speech Mark Types](https://docs.aws.amazon.com/polly/latest/dg/speechmarks.html) as follows:

```php
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMark;

$speechFile = $speech
    ->voiceId(UnitedStates::Joanna)
    ->asMp3()
    ->text('Hello World')
    // You may also add more options, such as: Sentence, Ssml etc...
    ->speechMarks(SpeechMark::Word)
    ->convert();
```

> The `speechMarks()` method issues another request to get the speech marks.

```php
array (
    =>
        (object) [
            'time' => 6,
            'type' => 'word',
            'start' => 0,
            'end' => 5,
            'value' => 'Hello',
        ],
    =>
        (object) [
            'time' => 374,
            'type' => 'word',
            'start' => 6,
            'end' => 11,
            'value' => 'World',
        ]
);
```

## Standard vs Neural Voices

Amazon Polly provides two voice systems `Standard` and `Neural`.

The `Neural` system can produce higher quality voices than the standard voices.

By default, this package will always use the `Standard` voice if available, otherwise it uses the `Neural` voice.

You may use the `neuralVoice()` or `standardVoice()` methods as follows:

```php
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMark;
use AhmadMayahi\Polly\Enums\VoiceType;

$speechFile = $speech
    ->voiceId(UnitedStates::Joanna)
    ->asMp3()
    ->text('Hello World')
    ->neuralVoice()
    ->convert();
```

> Not all the voices support the `nueral` system, for more information please visit [Voices in Amazon Polly](https://docs.aws.amazon.com/polly/latest/dg/voicelist.html) page.

## Voice Methods

PHP Amazon Polly provides a convenient way to get the appropriate voice id.

For example, if you want to use `Joanna` you may use `englishUnitedStatesJoanna()` method as follows:

```php
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMark;
use AhmadMayahi\Polly\Enums\VoiceType;

$speechFile = $speech
    // $neural is optional
    ->englishUnitedStatesJoanna($neural = true)
    ->asMp3()
    ->text('Hello World')
    ->convert();
```

Here is the full list of voices with their equivalent method:

| Voice                       | Method                                     |
|-----------------------------|--------------------------------------------|
| Arabic (Zeina)              | `arabicZeina()`                            |
| Chinese (Zhiyu)             | `chineseZhiyu()`                           |
| Danish (Naja)               | `danishNaja()`                             |
| Danish (Mads)               | `danishMads()`                             |
| Dutch (Lotte)               | `dutchLotte()`                             |
| Dutch (Ruben)               | `dutchLotte()`                             |
| English Australian (Nicole) | `englishAustralianNicole()`                |
| English Australian (Olivia) | `englishAustralianOlivia($neural = false)` |
| English Australian (Russel) | `englishAustralianRussel()`                |
| English British (Amy)       | `englishBritishAmy($neural = false)`       |


## Voice Enums

All the [Amazon Polly Voices](https://docs.aws.amazon.com/polly/latest/dg/voicelist.html) are supported:

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
use AhmadMayahi\Polly\Enums\Voices\English\Australian;

Australian::Nicole;
```

### Describe Voice

You can also describe the voice using the `describe` method as follows:

```php
use AhmadMayahi\Polly\Enums\Voices\English\Australian;

Australian::Nicole->describe();
```

The `describe` method returns an object of type `AhmadMayahi\Polly\Data\DescribeVoice` with the following properties:

* `gender`: Determines the voice's gender. 
* `neural`: Is it Neural Voice?
* `standard`: Is it Standard Voice?
* `bilingual`: Is it bilingual? [Read more](https://docs.aws.amazon.com/polly/latest/dg/bilingual-voices.html).
* `newscaster`: Does it do a newscaster speaking style? [Read more](https://docs.aws.amazon.com/polly/latest/dg/ntts-speakingstyles.html)

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
