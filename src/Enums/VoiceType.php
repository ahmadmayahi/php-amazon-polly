<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums;

enum VoiceType: string
{
    case Auto = 'auto';

    case Standard = 'standard';

    case Neural = 'neural';
}
