<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\NGramCount;

final class Model
{
    public Config $config;

    /** @var array<string, Element> */
    public array $elements = [];

    public int $elementCount;

    /** @var array<string, int> */
    public array $firstElements = [];

    public int $firstElementsCount;

    public int $firstelementsWeightCount;

    /** @var array<array<string, int>> */
    public array $sentenceElements = [];

    /** @var array<string, int */
    public array $sentenceElementsCount = [];

    /** @var array<string, int */
    public array $sentenceElementsWeightCount = [];

    /** @var array<int, int> */
    public array $wordLengths = [];

    public int $wordLengthsCount;

    public int $wordLengthsWeightCount;

    /** @var array<int, int> */
    public array $sentenceLengths = [];

    public int $sentenceLengthsCount;

    public int $sentenceLengthsWeightCount;

    /** @var array<string> */
    public array $excludedWords = [];

    public int $excludedWordsCount;

    public function __construct(string $name)
    {
        $this->config = new Config($name);
    }

    private function feedWordLenghts(array $words): void
    {
        foreach ($words as $word) {
            $wordLength = mb_strlen($word);
            NGramCount::elementOnArray((string) $wordLength, $this->wordLengths);
        }
    }

    private function feedSentenceLenghts(int $lenght): void
    {
        NGramCount::elementOnArray((string) $lenght, $this->sentenceLengths);
    }

    public function feed(string $text): self
    {
        $tokenizedSentences = $this->config->tokenizer->tokenizeBySentences($text);

        foreach ($tokenizedSentences as $sentence) {
            $this->feedWordLenghts($sentence);
            $this->feedSentenceLenghts(count($sentence));

            if ($this->config->excludeOriginals === true) {
                $this->excludedWords[] = $sentence;
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
                            $previousElement->addLastChildren($ngram);
                        } else {
                            $previousElement->addChildren($ngram);
                        }
                    }

                    $previousElement = $ngramElement;
                }
            }
        }

        return $this;
    }

    private function calculateElements(): void
    {
        /** @var \Phonyland\LanguageModel\Element $element */
        foreach ($this->elements as $ngram => $element) {
            $this->elements[$ngram] = $element->calculate()->toArray();
        }

        // Sort elements by ngrams
        ksort($this->elements);

        $this->elementCount = count($this->elements);
    }

    private function calculateFirstelements(): void
    {
        arsort($this->firstElements);
        $this->firstElementsCount       = count($this->firstElements);
        $this->firstelementsWeightCount = array_sum($this->firstElements);
    }

    private function calculateSentenceElements(): void
    {
        foreach ($this->sentenceElements as $index => $sentenceElement) {
            arsort($this->sentenceElements[$index]);
            $this->sentenceElementsCount[$index]       = count($sentenceElement);
            $this->sentenceElementsWeightCount[$index] = array_sum($sentenceElement);
        }
        krsort($this->sentenceElements);
    }

    private function calculateWordLenghts(): void
    {
        arsort($this->wordLengths);
        $this->wordLengthsCount       = count($this->wordLengths);
        $this->wordLengthsWeightCount = array_sum($this->wordLengths);
    }

    private function calculateSentenceLenghts(): void
    {
        arsort($this->sentenceLengths);
        $this->sentenceLengthsCount       = count($this->sentenceLengths);
        $this->sentenceLengthsWeightCount = array_sum($this->sentenceLengths);
    }

    private function calculateExludedWords(): void
    {
        // Flatten exluded word arrays and sort
        $this->excludedWords = array_merge(...$this->excludedWords);

        sort($this->excludedWords);

        $this->excludedWordsCount = count($this->excludedWords);
    }

    public function calculate(): self
    {
        $this->calculateElements();
        $this->calculateFirstelements();
        $this->calculateSentenceElements();
        $this->calculateWordLenghts();
        $this->calculateSentenceLenghts();
        $this->calculateExludedWords();

        return $this;
    }

    public function toArray(): array
    {
        return [
            'config'   => $this->config->toArray(),
            'data'     => [
                'elements'                       => $this->elements,
                'elements_count'                 => $this->elementCount,
                'first_elements'                 => $this->firstElements,
                'first_elements_count'           => $this->firstElementsCount,
                'first_elements_weight_count'    => $this->firstelementsWeightCount,
                'sentence_elements'              => $this->sentenceElements,
                'sentence_elements_count'        => $this->sentenceElementsCount,
                'sentence_elements_weight_count' => $this->sentenceElementsWeightCount,
                'word_lengths'                   => $this->wordLengths,
                'word_lenghts_count'             => $this->wordLengthsCount,
                'word_lenghts_weight_count'      => $this->wordLengthsWeightCount,
                'sentence_lengths'               => $this->sentenceLengths,
                'sentence_lenghts_count'         => $this->sentenceLengthsCount,
                'sentence_lenghts_weight_count'  => $this->sentenceLengthsWeightCount,
                'excluded_words'                 => $this->excludedWords,
                'excluded_words_count'           => $this->excludedWordsCount,
            ],
        ];
    }
}
