<?php

namespace AhmadMayahi\Polly\Enums;

enum TextType: string
{
    case Text = 'text';

    /**
     * Speech Synthesis Markup Language (SSML).
     * Using SSML-enhanced text gives you additional control over how Amazon Polly generates speech
     * from the text you provide.
     *
     * @see https://docs.aws.amazon.com/polly/latest/dg/ssml.html
     */
    case Ssml = 'ssml';
}
