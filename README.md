
<div align="center">
  <img style="width:300px" src="art/logo.png" alt="PHP Google Vision" />

<hr>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ahmadmayahi/php-amazon-polly.svg)](https://packagist.org/packages/ahmadmayahi/php-amazon-polly)
[![Total Downloads](https://img.shields.io/packagist/dt/ahmadmayahi/php-amazon-polly.svg)](https://packagist.org/packages/ahmadmayahi/php-amazon-polly)
[![Tests](https://github.com/ahmadmayahi/php-amazon-polly/actions/workflows/run-tests.yml/badge.svg)](https://github.com/ahmadmayahi/php-amazon-polly/actions/workflows/run-tests.yml)
[![Check & fix styling](https://github.com/ahmadmayahi/php-amazon-polly/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/ahmadmayahi/php-amazon-polly/actions/workflows/php-cs-fixer.yml)
<br/>
[![Test Coverage](https://codecov.io/gh/ahmadmayahi/php-amazon-polly/branch/main/graph/badge.svg?token=hayMyn8tLI)](https://codecov.io/gh/ahmadmayahi/php-amazon-polly)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/ahmadmayahi/php-amazon-polly/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/ahmadmayahi/php-amazon-polly/?branch=main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/ahmadmayahi/php-amazon-polly/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)

<hr/>

</div>

**Requires PHP 8.1+**

For feedback, please [contact me](https://form.jotform.com/201892949858375).

**PHP Amazon Polly** is an easy and elegant wrapper around [Amazon Polly](https://aws.amazon.com/polly/), a service that turns text into lifelike speech.

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

Return the text in `MP3` format:

```php
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Enums\OutputFormat;

$speechFile = $speech
    // All Amazon voices are supported  
    ->voice(UnitedStates::Joanna)
    
    // Available options: Mp3, Ogg, Pcm, Json
    ->outputFormat(OutputFormat::Mp3)
    
    // Desired Text
    ->text('Hello World')
    
    // Available options; Text, Ssml
    ->textType(TextType::Text)
    
    // Returns an object of type `AhmadMayahi\Polly\Data\SpeechFile`.
    ->convert();
```

Get the `MP3` file:

```php
// The `file` is of type SplFileObject
$speechFile->file;
```

You may also request the [Speech Mark Types](https://docs.aws.amazon.com/polly/latest/dg/speechmarks.html) as follows:

```php
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;
use AhmadMayahi\Polly\Enums\OutputFormat;
use AhmadMayahi\Polly\Enums\SpeechMarkType;

$speechFile = $speech
    ->voice(EnglishUS::Joanna)
    ->outputFormat(Output::mp3)
    ->text('Hello World')
    ->textType(TextType::Text)
    // You may also add more options, such as: Sentence, Ssml etc...
    ->speechMarks(SpeechMarkType::Word)
    ->convert();
```

> The `speechMarks` methods issues another request to get the speech marks.

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

## Voices

All the [Amazon Polly Voices](https://docs.aws.amazon.com/polly/latest/dg/voicelist.html) are supported:

| Language                | Enum                                                   |
|-------------------------|--------------------------------------------------------|
| Arabic                  | `AhmadMayahi\Polly\Enums\Voices\Arabic`                |
| Chinese, Mandarin       | `AhmadMayahi\Polly\Enums\Voices\Chinese`               |
| Danish                  | `AhmadMayahi\Polly\Enums\Voices\Danish`                |
| Dutch                   | `AhmadMayahi\Polly\Enums\Voices\Dutch`                 |
| English (Australian)    | `AhmadMayahi\Polly\Enums\Voices\English\Australian`    |
| English (British)       | `AhmadMayahi\Polly\Enums\Voices\English\British`       |
| English (Indian)        | `AhmadMayahi\Polly\Enums\Voices\English\Indian`        |
| English (New Zealand)   | `AhmadMayahi\Polly\Enums\Voices\English\NewZealand)`   |
| English (South African) | `AhmadMayahi\Polly\Enums\Voices\English\SouthAfrican)` |
| English (United States) | `AhmadMayahi\Polly\Enums\Voices\English\UnitedStates)` |
| French                  | `AhmadMayahi\Polly\Enums\Voices\French\French)`        |
| French (Canadian)       | `AhmadMayahi\Polly\Enums\Voices\French\Canadian)`      |
| German                  | `AhmadMayahi\Polly\Enums\Voices\German)`               |
| Hindi                   | `AhmadMayahi\Polly\Enums\Voices\Hindi)`                |
| Icelandic               | `AhmadMayahi\Polly\Enums\Voices\Icelandic)`            |
| Italian                 | `AhmadMayahi\Polly\Enums\Voices\Italian)`              |
| Japanese                | `AhmadMayahi\Polly\Enums\Voices\Japanese)`             |
| Korean                  | `AhmadMayahi\Polly\Enums\Voices\Korean)`               |
| Portuguese (Brazilian)  | `AhmadMayahi\Polly\Enums\Voices\Portuguese\Brazilian)` |
| Portuguese (Portugal)   | `AhmadMayahi\Polly\Enums\Voices\Portuguese\Portugal)`  |
| Romanian                | `AhmadMayahi\Polly\Enums\Voices\Romanian)`             |
| Russian                 | `AhmadMayahi\Polly\Enums\Voices\Russian)`              |
| Spanish (Mexican)       | `AhmadMayahi\Polly\Enums\Voices\Spanish\Mexican)`      |
| Spanish (Spain)         | `AhmadMayahi\Polly\Enums\Voices\Spanish\Spain)`        |
| Spanish (United States) | `AhmadMayahi\Polly\Enums\Voices\Spanish\UnitedStates)` |
| Swedish                 | `AhmadMayahi\Polly\Enums\Voices\Swedish)`              |
| Turkish                 | `AhmadMayahi\Polly\Enums\Voices\Turkish)`              |
| Welsh                   | `AhmadMayahi\Polly\Enums\Voices\Welsh)`                |

For example, if you want to get `Gabrielle` from French (Canadian):

```php
\AhmadMayahi\Polly\Enums\Voices\French\Canadian::Gabrielle;
```

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
