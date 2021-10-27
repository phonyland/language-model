<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\NGramCount;
use Phonyland\NGram\NGramFrequency;

final class Model
{
    public Config $config;

    /** @var array<array<string>> */
    private array $tokenizedSentences = [];

    /** @var array<string, Element> */
    private array $elements = [];

    /** @phpstan-var array<string, float> $firstElements */
    private array $firstElements = [];







    /** @phpstan-var array<string> $excluded */
    private array $excluded = [];

    public function __construct(string $name)
    {
        $this->config = new Config($name);
    }

    /**
     * @phpstan-return array<array>
     */
    public function build(string $text): array
    {
        $this->tokenizedSentences = $this->config->tokenizer->tokenizeBySentences($text);

        foreach ($this->tokenizedSentences as $sentence) {
            foreach ($sentence as $token) {
                $ngramCount = mb_strlen($token) - $this->config->n + 1;

                /** @var \Phonyland\LanguageModel\Element|null $previousElement */
                $previousElement = null;

                for ($i = 0; $i < $ngramCount; $i++) {
                    $ngram = mb_substr($token, $i, $this->config->n);

                    /** @var \Phonyland\LanguageModel\Element|null $ngramElement */
                    $ngramElement                 = array_key_exists($ngram, $this->elements)
                        ? $this->elements[$ngram]
                        : ($this->elements[$ngram] = new Element($ngram));

                    if ($i === 0) {
                        NGramCount::elementOnArray($ngram, $this->firstElements);
                    }

                    if ($previousElement !== null) {
                        // check if it is the last children or not
                        if ($i === $ngramCount - 1) {
                            $previousElement->countLastChildren($ngram);
                        } else {
                            $previousElement->countChildren($ngram);
                        }
                    }

                    $previousElement = $ngramElement;
                }
            }
        }

        $nGramKeys     = array_keys($this->elements);
        $nGramKeyCount = count($nGramKeys);

        for ($i = 0; $i < $nGramKeyCount; $i++) {
            $ngram = $nGramKeys[$i];
            /** @var \Phonyland\LanguageModel\Element $ngramElement */
            $ngramElement = $this->elements[$ngram];

            $ngramElement->calculateChildrenFrequency();
            $ngramElement->calculateLastChildrenFrequency();

            $this->elements[$nGramKeys[$i]] = [
                array_keys($ngramElement->children) !== [] ? $ngramElement->children : 0,
                array_keys($ngramElement->lastChildren) !== [] ? $ngramElement->lastChildren : 0,
            ];
        }

        NGramFrequency::frequencyFromCount($this->firstElements);

        return [
            'config' => '', // $this->config->toArray(),
            'data'   => [
                'fe'  => $this->firstElements,
                'sf1' => '',
                'sf2' => '',
                'sf3' => '',
                'sl1' => '',
                'sl2' => '',
                'sl3' => '',
                'e'   => $this->excluded,
            ],
        ];
    }
}
