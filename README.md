
<div align="center">
  <img style="width:300px" src="art/logo.png" alt="PHP Google Vision" />
</div>

<hr>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ahmadmayahi/php-polly.svg?style=flat-square)](https://packagist.org/packages/ahmadmayahi/php-polly)
[![Tests](https://github.com/ahmadmayahi/php-polly/actions/workflows/run-tests.yml/badge.svg?branch=main&style=flat-square)](https://github.com/ahmadmayahi/php-polly/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ahmadmayahi/php-polly.svg?style=flat-square)](https://packagist.org/packages/ahmadmayahi/php-polly)

PHP Polly is an easy and elegant wrapper around [aws polly](https://aws.amazon.com/polly/) (a service that turns text into lifelike speech).

## Installation

You can install the package via composer:

```bash
composer require ahmadmayahi/php-polly
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

$speech = Polly::init($config);

```

Return the text in `MP3` format:

```php
use AhmadMayahi\Polly\Enums\TextType;
use AhmadMayahi\Polly\Enums\Voices\English\UnitedStates;

$speechFile = $speech
    ->voice(UnitedStates::Joanna)
    ->outputFormat(Output::mp3)
    ->text('Hello World')
    ->textType(TextType::Text)
    ->save();
```

The `save` method returns an object of type `AhmadMayahi\Polly\Data\SpeechFile`.

Get the `MP3` file:

```php
// The `file` is of type SplFileObject
$speechFile->file;
```

You may also request the [speech mark types](https://docs.aws.amazon.com/polly/latest/dg/speechmarks.html) as follows:

```php
use AhmadMayahi\Polly\Enums\SpeechMarkType;

$speechFile = $speech
    ->voice(EnglishUS::Joanna)
    ->outputFormat(Output::mp3)
    ->text('Hello World')
    ->textType(TextType::Text)
    ->speechMarks(SpeechMarkType::word, SpeechMarkType::Sentence)
    ->save();
```

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
