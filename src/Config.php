<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\Tokenizer;
use RuntimeException;

/***
 * @internal
 */
final class Config
{
    // region Attributes

    public string $name                  = 'Phony Language Model';
    public ?Tokenizer $tokenizer         = null;
    public int $n                        = 2;
    public int $minLenght                = 2;
    public bool $unique                  = false;
    public bool $excludeOriginals        = false;
    public int $frequencyPrecision       = 7;
    public int $numberOfSentenceElements = 5;

    // endregion

    // region Public Methods

    public function __construct(?string $name = null, ?Tokenizer $tokenizer = null)
    {
        if ($name !== null) {
            $this->name = $name;
        }
        if ($tokenizer !== null) {
            $this->tokenizer = $tokenizer;
        }
    }

    public function toArray(): array
    {
        return [
            'name'                        => $this->name,
            'n'                           => $this->n,
            'min_lenght'                  => $this->minLenght,
            'unique'                      => $this->unique,
            'exclude_originals'           => $this->excludeOriginals,
            'frequency_precision'         => $this->frequencyPrecision,
            'number_of_sentence_elements' => $this->numberOfSentenceElements,
            'tokenizer'                   => $this->tokenizer->toArray(),
        ];
    }

    // endregion

    // region Fluent Setters

    public function name(string $name): Config
    {
        $this->name = $name;

        return $this;
    }

    public function tokenizer(Tokenizer $tokenizer): Config
    {
        $this->tokenizer = $tokenizer;

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

    public function numberOfSentenceElements(int $numberOfSentenceElements): Config
    {
        if ($numberOfSentenceElements < 0) {
            throw new RuntimeException('The $numberOfSentenceElements must be greater than or equal to 0');
        }

        $this->numberOfSentenceElements = $numberOfSentenceElements;

        return $this;
    }

    //endregion
}
