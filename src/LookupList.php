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
        protected array $elementIndex = [],
        /** @var array<int, int> $weightIndex */
        protected array $weightIndex = [],
        /** @var array<int, int> $cumulativeWeightIndex */
        protected array $cumulativeWeightIndex = [],
        /** @var array<string, int> $indexElements */
        protected array $indexElements = [],
        protected int $sumOfWeights = 0,
        protected int $count = 0,
        /** @var array<string, int> $elements */
        protected array $elements = [],
    ) {
    }

    public function addElement(string $element): self
    {
        NGramCount::incrementElementCount($element, $this->elements);

        return $this;
    }

    public function calculate(): self
    {
        asort($this->elements);
        $this->elementIndex = array_keys($this->elements);
        $this->weightIndex = array_values($this->elements);
        $this->indexElements = array_flip($this->elementIndex);
        $this->sumOfWeights = array_sum($this->weightIndex);
        $this->count = count($this->elements);

        $totalWeight = 0;
        foreach ($this->weightIndex as $index => $weight) {
            $totalWeight += $weight;
            $this->cumulativeWeightIndex[$index] = $totalWeight;
        }

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'e' => $this->elementIndex,
            'w' => $this->weightIndex,
            'cw' => $this->cumulativeWeightIndex,
            'i' => $this->indexElements,
            'sw' => $this->sumOfWeights,
            'c' => $this->count,
        ];
    }
}
