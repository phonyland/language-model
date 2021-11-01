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

    public Tokenizer $tokenizer;

    public string $name;
    public int $n                  = 2;
    public int $minLenght          = 2;
    public bool $unique            = false;
    public bool $excludeOriginals  = false;
    public int $frequencyPrecision = 7;
    public int $sentenceElements = 5;

    public int $elementsLimit                       = 500;
    public int $firstElementsLimit                  = 500;
    public int $sentenceElementsLimit               = 500;

    // endregion

    // region Public Methods

    public function __construct(string $name)
    {
        $this->name      = $name;
        $this->tokenizer = new Tokenizer();
    }

    public function toArray(): array
    {
        return [
            'name'                => $this->name,
            'n'                   => $this->n,
            'min_lenght'          => $this->minLenght,
            'unique'              => $this->unique,
            'exclude_originals'   => $this->excludeOriginals,
            'frequency_precision' => $this->frequencyPrecision,
            'limits' => [
                'elements'          => $this->elementsLimit,
                'first_elements'    => $this->firstElementsLimit,
                'sentence_elements' => $this->sentenceElementsLimit,
            ],
            'tokenizer' => $this->tokenizer->toArray(),
        ];
    }

    // endregion

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

    public function sentenceElements(int $sentenceElements): Config
    {
        if ($sentenceElements < 0) {
            throw new RuntimeException('The $sentenceElements must be greater than or equal to 0');
        }

        $this->sentenceElements = $sentenceElements;

        return $this;
    }

    public function limit(int $limit): Config
    {
        if ($limit < 1) {
            throw new RuntimeException('The $limit must be greater than 0');
        }

        $this->elementsLimit($limit);
        $this->firstElementsLimit($limit);
        $this->firstElementOfSentenceLimit($limit);
        $this->secondElementOfSentenceLimit($limit);
        $this->thirdElementOfSentenceLimit($limit);
        $this->lastElementOfSentenceLimit($limit);
        $this->secondToLastElementOfSentenceLimit($limit);
        $this->thirdToLastElementOfSentenceLimit($limit);

        return $this;
    }

    public function elementsLimit(int $elementsLimit): Config
    {
        if ($elementsLimit < 1) {
            throw new RuntimeException('The $elementsLimit must be greater than 0');
        }

        $this->elementsLimit = $elementsLimit;

        return $this;
    }

    public function firstElementsLimit(int $firstElementsLimit): Config
    {
        if ($firstElementsLimit < 1) {
            throw new RuntimeException('The $firstElementsLimit must be greater than 0');
        }

        $this->firstElementsLimit = $firstElementsLimit;

        return $this;
    }

    public function sentenceElementsLimit(int $sentenceElementsLimit): Config
    {
        if ($sentenceElementsLimit < 1) {
            throw new RuntimeException('The $sentenceElementsLimit must be greater than 0');
        }

        $this->sentenceElementsLimit = $sentenceElementsLimit;

        return $this;
    }

    //endregion
}
