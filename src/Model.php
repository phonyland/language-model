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

    public int $elementCount;

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
                            $previousElement->addLastChildren($ngram);
                        } else {
                            $previousElement->addChildren($ngram);
                        }
                    }

                    $previousElement = $ngramElement;
                }
            }
        }
    }

    public function calculate(): void
    {
        // Flatten exluded word arrays and sort
        $this->excluded = array_merge(...$this->excluded);

        sort($this->excluded);
        arsort($this->wordLengths);
        arsort($this->sentenceLengths);
        arsort($this->firstElements);

        foreach ($this->elements as $ngram => $element) {
            $this->elements[$ngram] = $element->toArray();
        }

        // Sort sentence elements counts
        foreach ($this->sentenceElements as $index => $sentenceElement) {
            arsort($this->sentenceElements[$index]);
        }

        $this->elementCount = count($this->elements);
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
                'word_lengths'         => $this->wordLengths,
                'element_count'        => $this->elementCount,
                'sentence_lengths'     => $this->sentenceLengths,
            ],
            'excluded' => $this->excluded,
        ];
    }
}
