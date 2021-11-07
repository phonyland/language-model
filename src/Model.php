<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\NGramCount;
use Phonyland\NGram\NGramFrequency;

final class Model
{
    public Config $config;

    // region Data Attributes

    /** @var array<string, Element> */
    public array $elements = [];

    /** @var array<string, float> */
    public array $firstElements = [];

    /** @var array<array<string, float>> */
    public array $sentenceElements = [];

    // endregion

    // region Statistic Attributes

    /** @var array<int, float> */
    public array $wordLengths = [];

    /** @var array<int, float> */
    public array $sentenceLengths = [];

    // endregion

    /** @var array<string> */
    public array $excluded = [];

    public function __construct(string $name)
    {
        $this->config = new Config($name);
    }

    private function calculateWordLenghts(array $words): void
    {
        foreach ($words as $word) {
            $wordLength = mb_strlen($word);
            NGramCount::elementOnArray((string) $wordLength, $this->wordLengths);
        }
    }

    private function calculateSentenceLenghts(int $lenght): void
    {
        NGramCount::elementOnArray((string)$lenght, $this->sentenceLengths);
    }

    public function feed(string $text): void
    {
        $tokenizedSentences = $this->config->tokenizer->tokenizeBySentences($text);

        foreach ($tokenizedSentences as $sentence) {
            $this->calculateWordLenghts($sentence);
            $this->calculateSentenceLenghts(count($sentence));

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

                        if ($numberOfWordsInSentence - 1 >= $orderInSentence && $orderInSentence <= ($this->config->numberOfSentenceElements - 1)) {
                            if (!isset($this->sentenceElements[$orderInSentence + 1])) {
                                $this->sentenceElements[$orderInSentence + 1] = [];
                            }
                            NGramCount::elementOnArray($ngram, $this->sentenceElements[$orderInSentence + 1]);
                        }

                        $positionFromLast = ($numberOfWordsInSentence - 1) - $orderInSentence;
                        if ($positionFromLast <= ($this->config->numberOfSentenceElements - 1) && $positionFromLast >= 0) {
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

    public function calculateWithFrequencies(): void
    {
        // Flatten exluded word arrays and sort
        $this->excluded = array_merge(...$this->excluded);
        sort($this->excluded);

        // Calculate and sort word lenght frequencies
        NGramFrequency::frequencyFromCount($this->wordLengths);
        arsort($this->wordLengths);

        // Calculate and sort sentence lenght frequencies
        NGramFrequency::frequencyFromCount($this->sentenceLengths);
        arsort($this->sentenceLengths);

        // Calculate element frequencies
        $nGramKeys     = array_keys($this->elements);
        $nGramKeyCount = count($nGramKeys);

        for ($i = 0; $i < $nGramKeyCount; $i++) {
            $ngram = $nGramKeys[$i];
            /** @var \Phonyland\LanguageModel\Element $ngramElement */
            $ngramElement = $this->elements[$ngram];

            $ngramElement->calculateChildrenFrequency();
            $ngramElement->sortChildrenByCount();
            $ngramElement->calculateLastChildrenFrequency();
            $ngramElement->sortLastChildrenByCount();

            $this->elements[$nGramKeys[$i]] = [
                array_keys($ngramElement->children) !== [] ? $ngramElement->children : 0,
                array_keys($ngramElement->lastChildren) !== [] ? $ngramElement->lastChildren : 0,
            ];
        }

        // Calculate and sort first elements frequency
        NGramFrequency::frequencyFromCount($this->firstElements);
        arsort($this->firstElements);

        // Calculate and sort sentence elements frequency
        foreach ($this->sentenceElements as $index => $sentenceElement) {
            NGramFrequency::frequencyFromCount($this->sentenceElements[$index]);
            arsort($this->sentenceElements[$index]);
        }
    }

    public function calculateWithCounts(): void
    {
        // Flatten exluded word arrays and sort
        $this->excluded = array_merge(...$this->excluded);
        sort($this->excluded);

        // Sort word lenght counts
        arsort($this->wordLengths);

        // sort sentence lenght counts
        arsort($this->sentenceLengths);

        // Sort element counts
        $nGramKeys     = array_keys($this->elements);
        $nGramKeyCount = count($nGramKeys);

        for ($i = 0; $i < $nGramKeyCount; $i++) {
            $ngram = $nGramKeys[$i];
            /** @var \Phonyland\LanguageModel\Element $ngramElement */
            $ngramElement = $this->elements[$ngram];

            $ngramElement->sortChildrenByCount();
            $ngramElement->sortLastChildrenByCount();

            $this->elements[$nGramKeys[$i]] = [
                array_keys($ngramElement->children) !== [] ? $ngramElement->children : 0,
                array_keys($ngramElement->lastChildren) !== [] ? $ngramElement->lastChildren : 0,
            ];
        }

        // Sort first elements counts
        arsort($this->firstElements);

        // Sort sentence elements counts
        foreach ($this->sentenceElements as $index => $sentenceElement) {
            arsort($this->sentenceElements[$index]);
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
            'statistics' => [
                'word_lengths'     => $this->wordLengths,
                'sentence_lengths' => $this->sentenceLengths,
            ],
            'excluded' => $this->excluded,
        ];
    }
}
