<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\NGramCount;

/***
 * @internal
 */
final class Element
{
    public function __construct(
        public string $ngram,
        /** @var array<string, int> $children */
        public array $children = [],
        /** @var array<string, int> $childrenLookup */
        public array $childrenLookup = [],
        public int $childrenCount = 0,
        public int $childrenWeightCount = 0,
        /** @var array<string, int> $lastChildren */
        public array $lastChildren = [],
        /** @var array<string, int> $lastChildrenLookup */
        public array $lastChildrenLookup = [],
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
        $this->childrenCount       = count($this->children);
        $this->childrenWeightCount = array_sum($this->children);
        Model::calculateLookup($this->children, $this->childrenLookup);

        arsort($this->lastChildren);
        $this->lastChildrenCount       = count($this->lastChildren);
        $this->lastChildrenWeightCount = array_sum($this->lastChildren);
        Model::calculateLookup($this->lastChildren, $this->lastChildrenLookup);

        return $this;
    }

    public function toArray(): array
    {
        return array_filter([
            'c'    => $this->children,
            'cl'   => $this->childrenLookup,
            'cc'   => $this->childrenCount,
            'cwc'  => $this->childrenWeightCount,
            'lc'   => $this->lastChildren,
            'lcl'  => $this->lastChildrenLookup,
            'lcc'  => $this->lastChildrenCount,
            'lcwc' => $this->lastChildrenWeightCount,
        ]);
    }
}
