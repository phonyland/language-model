<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\NGramCount;
use Phonyland\NGram\NGramFrequency;

final class Model
{
    public Config $config;

    /** @var array<string, Element> */
    public array $elements = [];

    /** @var array<string, float> */
    public array $firstElements = [];

    /** @var array<array<string, float>> */
    public array $sentenceElements = [];

    /** @var array<string> */
    public array $excluded = [];

    public function __construct(string $name)
    {
        $this->config = new Config($name);
    }

    public function feed(string $text): void
    {
        $tokenizedSentences = $this->config->tokenizer->tokenizeBySentences($text);

        foreach ($tokenizedSentences as $sentence) {
            if ($this->config->excludeOriginals === true) {
                $this->excluded[] = $sentence;
            }

            $numberOfWordsInSentence = count($sentence);
            foreach ($sentence as $orderInSentence => $token) {
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

                        if ($numberOfWordsInSentence - 1 >= $orderInSentence && $orderInSentence <= ($this->config->sentenceElements - 1)) {
                            if (!isset($this->sentenceElements[$orderInSentence + 1])) {
                                $this->sentenceElements[$orderInSentence + 1] = [];
                            }
                            NGramCount::elementOnArray($ngram, $this->sentenceElements[$orderInSentence + 1]);
                        }

                        $positionFromLast = ($numberOfWordsInSentence - 1) - $orderInSentence;
                        if ($positionFromLast <= ($this->config->sentenceElements - 1) && $positionFromLast >= 0) {
                            if (!isset($this->sentenceElements[($positionFromLast + 1) * -1])) {
                                $this->sentenceElements[($positionFromLast + 1) * -1] = [];
                            }
                            NGramCount::elementOnArray($ngram, $this->sentenceElements[($positionFromLast + 1) * -1]);
                        }

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
    }

    public function calculate(): void
    {
        // Flatten exluded word arrays
        $this->excluded = array_merge(...$this->excluded);

        // Calculate element frequencies
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

        // Calculate first elements frequency
        NGramFrequency::frequencyFromCount($this->firstElements);

        // Calculate sentence elements frequency
        foreach ($this->sentenceElements as $index => $sentenceElement) {
            NGramFrequency::frequencyFromCount($this->sentenceElements[$index]);
        }
    }

    public function toArray(): array
    {
        return [
            'config'   => $this->config->toArray(),
            'data'     => [
                'elements'          => $this->elements,
                'first_elements'    => $this->firstElements,
                'sentence_elements' => $this->sentenceElements,
            ],
            'excluded' => $this->excluded,
        ];
    }
}
