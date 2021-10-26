<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\NGramCount;
use Phonyland\NGram\NGramFrequency;

/***
 * @internal
 */
final class Element
{
    public function __construct(
        public string $ngram,
        /** @var array<string, float> $children */
        public array $children = [],
        /** @var array<string, float> $lastChildren */
        public array $lastChildren = [],
    ) {}

    public function countLastChildren(string $ngram): void
    {
        NGramCount::elementOnArray($ngram, $this->lastChildren);
    }

    public function countChildren(string $ngram): void
    {
        NGramCount::elementOnArray($ngram, $this->children);
    }

    public function calculateChildrenFrequency(): void
    {
        NGramFrequency::frequencyFromCount($this->children);
    }

    public function calculateLastChildrenFrequency(): void
    {
        NGramFrequency::frequencyFromCount($this->lastChildren);
    }
}
