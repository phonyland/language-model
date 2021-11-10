<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

final class Model
{
    public Config $config;

    /** @var array<string, Element> */
    public array $elements = [];

    public int $elementCount;

    public LookupList $firstElements;

    /** @var array<\Phonyland\LanguageModel\LookupList> */
    public array $sentenceElements = [];

    public LookupList $wordLengths;

    public LookupList $sentenceLengths;

    /** @var array<string> */
    public array $excludedWords = [];

    public int $excludedWordsCount;

    public function __construct(string $name)
    {
        $this->config = new Config($name);
        $this->firstElements = new LookupList();
        $this->wordLengths = new LookupList();
        $this->sentenceLengths = new LookupList();
    }

    private function feedWordLenghts(array $words): void
    {
        foreach ($words as $word) {
            $wordLength = mb_strlen($word);
            $this->wordLengths->addElement((string)$wordLength);
        }
    }

    private function feedSentenceLenghts(int $lenght): void
    {
        $this->sentenceLengths->addElement((string)$lenght);
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
                        $this->firstElements->addElement($ngram);

                        if ($numberOfWordsInSentence - 1 >= $orderInSentence && $orderInSentence <= ($this->config->numberOfSentenceElements - 1)) {
                            if (!isset($this->sentenceElements[$orderInSentence + 1])) {
                                $this->sentenceElements[$orderInSentence + 1] = new LookupList();
                            }
                            $this->sentenceElements[$orderInSentence + 1]->addElement($ngram);
                        }

                        $positionFromLast = ($numberOfWordsInSentence - 1) - $orderInSentence;
                        if ($positionFromLast <= ($this->config->numberOfSentenceElements - 1) && $positionFromLast >= 0) {
                            if (!isset($this->sentenceElements[($positionFromLast + 1) * -1])) {
                                $this->sentenceElements[($positionFromLast + 1) * -1] = new LookupList();
                            }
                            $this->sentenceElements[($positionFromLast + 1) * -1]->addElement($ngram);
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

    private function calculateSentenceElements(): void
    {
        /** @var \Phonyland\LanguageModel\LookupList $sentenceElement */
        foreach ($this->sentenceElements as $sentenceElement) {
            $sentenceElement->calculate();
        }
        krsort($this->sentenceElements);
    }

    private function calculateExludedWords(): void
    {
        // Flatten and unique exluded word arrays and sort
        $this->excludedWords = array_unique(array_merge(...$this->excludedWords));

        sort($this->excludedWords);

        $this->excludedWordsCount = count($this->excludedWords);
    }

    public function calculate(): self
    {
        $this->calculateElements();
        $this->firstElements->calculate();
        $this->wordLengths->calculate();
        $this->sentenceLengths->calculate();
        $this->calculateSentenceElements();
        $this->calculateExludedWords();

        return $this;
    }

    public function toArray(): array
    {
        return [
            'config'   => $this->config->toArray(),
            'data'     => [
                'elements'          => $this->elements,
                'elements_count'    => $this->elementCount,
                'first_elements'    => $this->firstElements->toArray(),
                'sentence_elements' => array_map(static function (LookupList $sentenceElement) {
                    return $sentenceElement->calculate()->toArray();
                }, $this->sentenceElements),
                'word_lengths'      => $this->wordLengths->toArray(),
                'sentence_lengths'  => $this->sentenceLengths->toArray(),
            ],
            'excluded' => [
                'words' => $this->excludedWords,
                'count' => $this->excludedWordsCount,
            ],
        ];
    }
}
