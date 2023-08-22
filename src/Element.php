<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

/***
 * @internal
 */
final class Element
{
    public function __construct(
        public string $ngram,
        public ?LookupList $children = null,
        public ?LookupList $lastChildren = null,
    ) {
        $this->children = $children ?? new LookupList();
        $this->lastChildren = $lastChildren ?? new LookupList();
    }

    public function addChildren(string $ngram): self
    {
        $this->children->addElement($ngram);

        return $this;
    }

    public function addLastChildren(string $ngram): self
    {
        $this->lastChildren->addElement($ngram);

        return $this;
    }

    public function calculate(): self
    {
        $this->children->calculate();
        $this->lastChildren->calculate();

        return $this;
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public function toArray(): array
    {
        return [
            'c' => $this->children->toArray(),
            'lc' => $this->lastChildren->toArray(),
        ];
    }
}
