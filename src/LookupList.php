<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\NGramCount;

/***
 * @internal
 */
final class LookupList
{
    public function __construct(
        /** @var array<int, string> $elementIndex */
        public array $elementIndex = [],
        /** @var array<int, int> $weightIndex */
        public array $weightIndex = [],
        /** @var array<int, int> $cumulativeWeightIndex */
        public array $cumulativeWeightIndex = [],
        /** @var array<string, int> $indexElements */
        public array $indexElements = [],
        public int $sumOfWeights = 0,
        /** @var array<string, int> $elements */
        private array $elements = [],
    ) {
    }

    public function addElement(string $element): self
    {
        NGramCount::elementOnArray($element, $this->elements);

        return $this;
    }

    public function calculate(): self
    {
        asort($this->elements);
        $this->elementIndex = array_keys($this->elements);
        $this->weightIndex = array_values($this->elements);
        $this->indexElements = array_flip($this->elementIndex);
        $this->sumOfWeights = array_sum($this->weightIndex);

        $totalWeight = 0;
        foreach ($this->weightIndex as $index => $weight) {
            $totalWeight += $weight;
            $this->cumulativeWeightIndex[$index] = $totalWeight;
        }

        return $this;
    }

    public function toArray(): array
    {
        return [
            'ei'  => $this->elementIndex,
            'wi'  => $this->weightIndex,
            'cwi' => $this->cumulativeWeightIndex,
            'ie'  => $this->indexElements,
            'sow'  => $this->sumOfWeights,
        ];
    }
}
