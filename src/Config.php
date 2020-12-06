<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use RuntimeException;

/***
 * @internal
 */
final class Config
{
    // region Attributes

    public Tokenizer $tokenizer;

    private string $name;
    private int $n                  = 2;
    private int $minLenght          = 2;
    private bool $unique            = false;
    private bool $excludeOriginals  = false;
    private int $frequencyPrecision = 7;

    private int $elementLimit        = 500;
    private int $elementFirstLimit   = 500;
    private int $sentenceFirst1Limit = 500;
    private int $sentenceFirst2Limit = 500;
    private int $sentenceFirst3Limit = 500;
    private int $sentenceLast1Limit  = 500;
    private int $sentenceLast2Limit  = 500;
    private int $sentenceLast3Limit  = 500;

    // endregion

    public function __construct(string $name)
    {
        $this->name      = $name;
        $this->tokenizer = new Tokenizer();
    }

    // region Fluent Setters

    public function name(string $name): Config
    {
        $this->name = $name;

        return $this;
    }

    public function n(int $n): Config
    {
        if ($n < 1) {
            throw new RuntimeException('The $n must be greater than 0');
        }

        $this->n = $n;

        return $this;
    }

    public function minLenght(int $minLenght): Config
    {
        if ($minLenght < $this->n) {
            throw new RuntimeException('The $minLength must be greater than or equal to $n');
        }

        $this->minLenght = $minLenght;

        return $this;
    }

    public function unique(bool $unique): Config
    {
        $this->unique = $unique;

        return $this;
    }

    public function excludeOriginals(bool $excludeOriginals): Config
    {
        $this->excludeOriginals = $excludeOriginals;

        return $this;
    }

    public function frequencyPrecision(int $frequencyPrecision): Config
    {
        if ($frequencyPrecision < 1) {
            throw new RuntimeException('The $frequencyPrecision must be greater than 0');
        }

        $this->frequencyPrecision = $frequencyPrecision;

        return $this;
    }

    public function limit(int $limit): Config
    {
        if ($limit < 1) {
            throw new RuntimeException('The $limit must be greater than 0');
        }

        $this->elementLimit($limit);
        $this->elementFirstLimit($limit);
        $this->sentenceFirst1Limit($limit);
        $this->sentenceFirst2Limit($limit);
        $this->sentenceFirst3Limit($limit);
        $this->sentenceLast1Limit($limit);
        $this->sentenceLast2Limit($limit);
        $this->sentenceLast3Limit($limit);

        return $this;
    }

    public function elementLimit(int $elementLimit): Config
    {
        if ($elementLimit < 1) {
            throw new RuntimeException('The $elementLimit must be greater than 0');
        }

        $this->elementLimit = $elementLimit;

        return $this;
    }

    public function elementFirstLimit(int $elementFirstLimit): Config
    {
        if ($elementFirstLimit < 1) {
            throw new RuntimeException('The $elementFirstLimit must be greater than 0');
        }

        $this->elementFirstLimit = $elementFirstLimit;

        return $this;
    }

    public function sentenceFirst1Limit(int $sentenceFirst1Limit): Config
    {
        if ($sentenceFirst1Limit < 1) {
            throw new RuntimeException('The $sentenceFirst1Limit must be greater than 0');
        }

        $this->sentenceFirst1Limit = $sentenceFirst1Limit;

        return $this;
    }

    public function sentenceFirst2Limit(int $sentenceFirst2Limit): Config
    {
        if ($sentenceFirst2Limit < 1) {
            throw new RuntimeException('The $sentenceFirst2Limit must be greater than 0');
        }

        $this->sentenceFirst2Limit = $sentenceFirst2Limit;

        return $this;
    }

    public function sentenceFirst3Limit(int $sentenceFirst3Limit): Config
    {
        if ($sentenceFirst3Limit < 1) {
            throw new RuntimeException('The $sentenceFirst3Limit must be greater than 0');
        }

        $this->sentenceFirst3Limit = $sentenceFirst3Limit;

        return $this;
    }

    public function sentenceLast1Limit(int $sentenceLast1Limit): Config
    {
        if ($sentenceLast1Limit < 1) {
            throw new RuntimeException('The $sentenceLast1Limit must be greater than 0');
        }

        $this->sentenceLast1Limit = $sentenceLast1Limit;

        return $this;
    }

    public function sentenceLast2Limit(int $sentenceLast2Limit): Config
    {
        if ($sentenceLast2Limit < 1) {
            throw new RuntimeException('The $sentenceLast2Limit must be greater than 0');
        }

        $this->sentenceLast2Limit = $sentenceLast2Limit;

        return $this;
    }

    public function sentenceLast3Limit(int $sentenceLast3Limit): Config
    {
        if ($sentenceLast3Limit < 1) {
            throw new RuntimeException('The $sentenceLast3Limit must be greater than 0');
        }

        $this->sentenceLast3Limit = $sentenceLast3Limit;

        return $this;
    }

    //endregion
}
