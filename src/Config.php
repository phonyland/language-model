<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

/***
 * @internal
 */
final class Config
{
    // region Attributes

    public Tokenizer $tokenizer;

    private string $name;
    private int $n = 2;
    private int $minLenght = 2;
    private bool $unique = false;
    private bool $excludeOriginals = false;
    private int $frequencyPrecision = 7;

    private int $elementLimit = 500;
    private int $elementFirstLimit = 500;
    private int $sentenceFirst1Limit = 500;
    private int $sentenceFirst2Limit = 500;
    private int $sentenceFirst3Limit = 500;
    private int $sentenceLast1Limit = 500;
    private int $sentenceLast2Limit = 500;
    private int $sentenceLast3Limit = 500;

    // endregion
}
