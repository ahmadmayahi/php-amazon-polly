<?php

declare(strict_types=1);

namespace AhmadMayahi\Polly\Enums;

/**
 * Speech marks are metadata that describe the speech that you synthesize,
 * such as where a sentence or word starts and ends in the audio stream.
 * When you request speech marks for your text, Amazon Polly returns this metadata
 * instead of synthesized speech.
 * By using speech marks in conjunction with the synthesized speech audio stream,
 * you can provide your applications with an enhanced visual experience.
 *
 * @link https://docs.aws.amazon.com/polly/latest/dg/speechmarks.html
 */
enum SpeechMarkType: string
{
    /**
     * Indicates a sentence element in the input text.
     */
    case Sentence = 'sentence';

    /**
     * Indicates a word element in the text.
     */
    case Word = 'word';

    /**
     * Describes the face and mouth movements corresponding to each phoneme being spoken.
     *
     * @see https://docs.aws.amazon.com/polly/latest/dg/viseme.html
     */
    case Viseme = 'viseme';

    /**
     * Describes a <mark> element from the SSML input text.
     *
     * @see https://docs.aws.amazon.com/polly/latest/dg/ssml.html
     */
    case Ssml = 'ssml';
}
