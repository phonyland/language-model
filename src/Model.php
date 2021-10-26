<?php

declare(strict_types=1);

namespace Phonyland\LanguageModel;

use Phonyland\NGram\NGramCount;
use Phonyland\NGram\NGramFrequency;

final class Model
{
    public Config $config;

    /** @var array<array<string>> $tokenizedSentences */
    private array $tokenizedSentences = [];

    /** @var array<string, Element> $elements */
    private array $elements = [];
    /** @phpstan-var array<string, float> $firstElements */
    private array $firstElements = [];
    /** @phpstan-var array<string, float> $sentenceFirst1 */
    private array $sentenceFirst1 = [];
    /** @phpstan-var array<string, float> $sentenceFirst2 */
    private array $sentenceFirst2 = [];
    /** @phpstan-var array<string, float> $sentenceFirst3 */
    private array $sentenceFirst3 = [];
    /** @phpstan-var array<string, float> $sentenceLast1 */
    private array $sentenceLast1 = [];
    /** @phpstan-var array<string, float> $sentenceLast2 */
    private array $sentenceLast2 = [];
    /** @phpstan-var array<string, float> $sentenceLast3 */
    private array $sentenceLast3 = [];

    /** @phpstan-var array<string> $excluded */
    private array $excluded = [];

    public function __construct(string $name)
    {
        $this->config = new Config($name);
    }

    /**
     *
     * @param  string  $text
     *
     * @phpstan-return array<array>
     * @return array
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
                    $ngramElement = !array_key_exists($ngram, $this->elements)
                        ? $this->elements[$ngram] = new Element($ngram)
                        : $this->elements[$ngram];

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

        $nGramKeys = array_keys($this->elements);
        $nGramKeyCount = count($nGramKeys);

        for ($i = 0; $i < $nGramKeyCount; $i++) {
            $ngram = $nGramKeys[$i];
            /** @var \Phonyland\LanguageModel\Element $ngramElement */
            $ngramElement = $this->elements[$ngram];

            $ngramElement->calculateChildrenFrequency();
            $ngramElement->calculateLastChildrenFrequency();

            $this->elements[$nGramKeys[$i]] = [
                count(array_keys($ngramElement->children)) > 0 ? $ngramElement->children : 0,
                count(array_keys($ngramElement->lastChildren)) > 0 ? $ngramElement->lastChildren : 0,
            ];
        }

        NGramFrequency::frequencyFromCount($this->firstElements);

        return [
            'config' => '', // $this->config->toArray(),
            'data'   => [
                'e'   => $this->elements,
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
