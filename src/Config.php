<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use RuntimeException;
use Phonyland\NGram\Tokenizer;

/***
 * @internal
 */
final class Config
{
    // region Attributes

    public string $name                  = 'Phony Language Model';
    public ?Tokenizer $tokenizer         = null;
    public int $nGramSize                = 2;
    public int $minWordLength            = 2;
    public bool $excludeOriginals        = false;
    public int $numberOfSentenceElements = 5;

    // endregion

    // region Public Methods

    public function __construct(string $name = null, Tokenizer $tokenizer = null)
    {
        if ($name !== null) {
            $this->name = $name;
        }

        if ($tokenizer !== null) {
            $this->tokenizer = $tokenizer;
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'name'                        => $this->name,
            'n_gram_size'                 => $this->nGramSize,
            'min_word_length'             => $this->minWordLength,
            'exclude_originals'           => $this->excludeOriginals,
            'number_of_sentence_elements' => $this->numberOfSentenceElements,
            'tokenizer'                   => $this->tokenizer->toArray(),
        ];
    }

    // endregion

    // region Fluent Setters

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function tokenizer(Tokenizer $tokenizer): self
    {
        $this->tokenizer = $tokenizer;

        return $this;
    }

    public function nGramSize(int $nGramSize): self
    {
        if ($nGramSize < 1) {
            throw new RuntimeException('The n-gram size must be greater than 0');
        }

        $this->nGramSize = $nGramSize;

        return $this;
    }

    public function minWordLength(int $minWordLength): self
    {
        if ($minWordLength < $this->nGramSize) {
            throw new RuntimeException('Minimum word length must be greater than or equal to $n');
        }

        $this->minWordLength = $minWordLength;

        return $this;
    }

    public function excludeOriginals(bool $excludeOriginals): self
    {
        $this->excludeOriginals = $excludeOriginals;

        return $this;
    }

    public function numberOfSentenceElements(int $numberOfSentenceElements): self
    {
        if ($numberOfSentenceElements < 0) {
            throw new RuntimeException('Number of sentence elements must be greater than or equal to 0');
        }

        $this->numberOfSentenceElements = $numberOfSentenceElements;

        return $this;
    }

    //endregion
}
