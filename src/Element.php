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
        /** @var array<string, int> $children */
        public array $children = [],
        /** @var array<string, int> $lastChildren */
        public int $childrenCount = 0,
        public int $childrenWeightCount = 0,
        public array $lastChildren = [],
        public int $lastChildrenCount = 0,
        public int $lastChildrenWeightCount = 0,
    ) {
    }

    public function addLastChildren(string $ngram): self
    {
        NGramCount::elementOnArray($ngram, $this->lastChildren);

        return $this;
    }

    public function addChildren(string $ngram): self
    {
        NGramCount::elementOnArray($ngram, $this->children);

        return $this;
    }

    public function calculate(): self
    {
        arsort($this->children);
        $this->childrenCount = count($this->children);
        $this->childrenWeightCount = array_sum($this->children);

        arsort($this->lastChildren);
        $this->lastChildrenCount = count($this->lastChildren);
        $this->lastChildrenWeightCount = array_sum($this->lastChildren);

        return $this;
    }

    public function toArray(): array
    {
       return array_filter([
            'c'    => $this->children,
            'cc'   => $this->childrenCount,
            'cwc'  => $this->childrenWeightCount,
            'lc'   => $this->lastChildren,
            'lcc'  => $this->lastChildrenCount,
            'lcwc' => $this->lastChildrenWeightCount,
        ]);
    }
}
