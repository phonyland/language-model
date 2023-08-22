<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

class Model
{
    // region Attributes

    public Config $config;

    /** @var array<string, Element> */
    public array $elements = [];

    public int $elementCount;

    public LookupList $firstElements;

    /** @var array<\Phonyland\LanguageModel\LookupList> */
    public array $sentenceElements = [];

    public LookupList $wordLengths;

    public LookupList $sentenceLengths;

    /** @var array<array<string>> */
    public array $excludedWords = [];

    public int $excludedWordsCount;

    // endregion

    public function __construct(string $name)
    {
        $this->config = new Config($name);
        $this->firstElements = new LookupList();
        $this->wordLengths = new LookupList();
        $this->sentenceLengths = new LookupList();
    }

    /**
     * @param  array<array<string>>  $words
     */
    private function feedWordLengths(array $words): void
    {
        /** @var string $word */
        foreach ($words as $word) {
            $wordLength = mb_strlen($word);
            $this->wordLengths->addElement((string) $wordLength);
        }
    }

    /**
     * @param  array<array<string>>  $words
     */
    private function feedSentenceLengths(array $words): int
    {
        $numberOfWordsInSentence = count($words);

        $this->sentenceLengths->addElement((string) $numberOfWordsInSentence);

        return $numberOfWordsInSentence;
    }

    /**
     * @param  array<array<string>>  $sentence
     */
    private function feedExcludedWords(array $sentence): void
    {
        if ($this->config->excludeOriginals === true) {
            $this->excludedWords[] = $sentence;
        }
    }

    public function feed(string $text): self
    {
        $tokenizedSentences = $this->config->tokenizer->tokenizeBySentences(
            $text,
            $this->config->minWordLength
        );

        /** @var array<array<string>> $sentence */
        foreach ($tokenizedSentences as $sentence) {
            $numberOfWordsInSentence = $this->feedSentenceLengths($sentence);
            $this->feedWordLengths($sentence);
            $this->feedExcludedWords($sentence);

            /** @var string $token */
            foreach ($sentence as $orderInSentence => $token) {
                $ngramCount = mb_strlen($token) - $this->config->nGramSize + 1;

                /** @var \Phonyland\LanguageModel\Element|null $previousElement */
                $previousElement = null;

                for ($i = 0; $i < $ngramCount; $i++) {
                    $ngram = mb_substr($token, $i, $this->config->nGramSize);

                    /** @var \Phonyland\LanguageModel\Element|null $ngramElement */
                    $ngramElement = array_key_exists($ngram, $this->elements)
                        ? $this->elements[$ngram]
                        : ($this->elements[$ngram] = new Element($ngram));

                    if ($i === 0) {
                        $this->firstElements->addElement($ngram);

                        if ($numberOfWordsInSentence - 1 >= $orderInSentence && $orderInSentence <= ($this->config->numberOfSentenceElements - 1)) {
                            if (! isset($this->sentenceElements[$orderInSentence + 1])) {
                                $this->sentenceElements[$orderInSentence + 1] = new LookupList();
                            }
                            $this->sentenceElements[$orderInSentence + 1]->addElement($ngram);
                        }

                        $positionFromLast = ($numberOfWordsInSentence - 1) - $orderInSentence;
                        if ($positionFromLast <= ($this->config->numberOfSentenceElements - 1) && $positionFromLast >= 0) {
                            if (! isset($this->sentenceElements[($positionFromLast + 1) * -1])) {
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
        // @phpstan-ignore-next-line
        $this->excludedWords = array_unique(array_merge(...$this->excludedWords));

        sort($this->excludedWords);

        $this->excludedWordsCount = count($this->excludedWords);
    }

    /**
     * @return $this
     */
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

    /**
     * @return array{config: array<mixed>, data: array<mixed>, excluded: array<mixed>}
     */
    public function toArray(): array
    {
        $sentenceElements = array_map(
            static fn (LookupList $se): array => $se->calculate()->toArray(),
            $this->sentenceElements
        );

        $excluded = $this->config->excludeOriginals === true
            ? [
                'words' => $this->excludedWords,
                'count' => $this->excludedWordsCount,
            ]
            : [
                'words' => [],
                'count' => 0,
            ];

        return [
            'config' => $this->config->toArray(),
            'data' => [
                'elements' => $this->elements,
                'elements_count' => $this->elementCount,
                'first_elements' => $this->firstElements->toArray(),
                'sentence_elements' => $sentenceElements,
                'word_lengths' => $this->wordLengths->toArray(),
                'sentence_lengths' => $this->sentenceLengths->toArray(),
            ],
            'excluded' => $excluded,
        ];
    }
}
