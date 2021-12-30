<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums;

enum OutputFormat: string
{
    case Json = 'json';

    case Mp3 = 'mp3';

    case Ogg = 'ogg_vorbis';

    case Pcm = 'pcm';
}
