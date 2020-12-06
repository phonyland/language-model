<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

/***
 * @internal
 */
final class NGramModelElement
{
    public string $ngram;

    /** @phpstan-var array<string, float> $children */
    public array $children = [];

    /** @phpstan-var array<string, float> $lastChildren */
    public array $lastChildren = [];

    public function __construct(string $ngram)
    {
        $this->ngram = $ngram;
    }

    /**
     * @phpstan-return array<string, array<int, array<string, float>>>
     */
    public function toArray(): array
    {
        return [
            $this->ngram => [
                $this->children,
                $this->lastChildren
            ]
        ];
    }
}