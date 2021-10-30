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

    /** @var array<string> */
    public array $excluded = [];

    /** @var array<string, float> */
    public array $firstElementOfSentence = [];

    /** @var array<string, float> */
    public array $secondElementOfSentence = [];

    /** @var array<string, float> */
    public array $thirdElementOfSentence = [];

    /** @var array<string, float> */
    public array $lastElementOfSentence = [];

    /** @var array<string, float> */
    public array $secondToLastElementOfSentence = [];

    /** @var array<string, float> */
    public array $thirdToLastElementOfSentence = [];

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

                        if ($orderInSentence === 0) {
                            NGramCount::elementOnArray($ngram, $this->firstElementOfSentence);
                        }

                        if ($orderInSentence === 1 && $numberOfWordsInSentence >= 2) {
                            NGramCount::elementOnArray($ngram, $this->secondElementOfSentence);
                        }

                        if ($orderInSentence === 2 && $numberOfWordsInSentence >= 3) {
                            NGramCount::elementOnArray($ngram, $this->thirdElementOfSentence);
                        }

                        if (($numberOfWordsInSentence - 1) === $orderInSentence && $numberOfWordsInSentence >= 2) {
                            NGramCount::elementOnArray($ngram, $this->lastElementOfSentence);
                        }

                        if (($numberOfWordsInSentence - 2) === $orderInSentence && $numberOfWordsInSentence >= 3) {
                            NGramCount::elementOnArray($ngram, $this->secondToLastElementOfSentence);
                        }

                        if (($numberOfWordsInSentence - 3) === $orderInSentence && $numberOfWordsInSentence >= 4) {
                            NGramCount::elementOnArray($ngram, $this->thirdToLastElementOfSentence);
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
        $this->excluded = array_merge(...$this->excluded);

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
        NGramFrequency::frequencyFromCount($this->firstElementOfSentence);
        NGramFrequency::frequencyFromCount($this->secondElementOfSentence);
        NGramFrequency::frequencyFromCount($this->thirdElementOfSentence);
        NGramFrequency::frequencyFromCount($this->lastElementOfSentence);
        NGramFrequency::frequencyFromCount($this->secondToLastElementOfSentence);
        NGramFrequency::frequencyFromCount($this->thirdToLastElementOfSentence);
    }

    /**
     * @param string $text
     *
     * @return array<array>
     */
    public function build(): array
    {
        return [
            'config'   => $this->config->toArray(),
            'data'     => [
                'elements'                           => $this->elements,
                'first_elements'                     => $this->firstElements,
                'first_element_of_sentence'          => $this->firstElementOfSentence,
                'second_element_of_sentence'         => $this->secondElementOfSentence,
                'third_element_of_sentence'          => $this->thirdElementOfSentence,
                'last_element_of_sentence'           => $this->lastElementOfSentence,
                'second_to_last_element_of_sentence' => $this->secondToLastElementOfSentence,
                'third_to_last_element_of_sentence'  => $this->thirdToLastElementOfSentence,
            ],
            'excluded' => $this->excluded,
        ];
    }
}
