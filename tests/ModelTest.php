<?php

declare(strict_types=1);

use Phonyland\LanguageModel\Model;
use Phonyland\NGram\Tokenizer;
use Phonyland\NGram\TokenizerFilter;

test('Model can be build with count', function (): void {
    $model = new Model('Test Model');

    $model->config->n(2)
                  ->minLenght(2)
                  ->unique(false)
                  ->excludeOriginals(true)
                  ->frequencyPrecision(7)
                  ->numberOfSentenceElements(3)
                  ->tokenizer((new Tokenizer())
                      ->addWordSeparatorPattern(TokenizerFilter::WHITESPACE_SEPARATOR)
                      ->addWordFilterRule(TokenizerFilter::LATIN_EXTENDED_ALPHABETICAL)
                      ->addSentenceSeparatorPattern(['.', '?', '!', ':', ';', '\n'])
                      ->toLowercase()
                  );

    $modelData = $model->feed('The quick brown fox jumps over the lazy dog.')
                       ->feed('Jived fox nymph grabs quick waltz.')
                       ->feed('Glib jocks quiz nymph to vex dwarf.')
                       ->feed('Sphinx of black quartz, judge my vow.')
                       ->feed('How vexingly quick daft zebras jump!')
                       ->feed('The five boxing wizards jump quickly.')
                       ->feed('Jackdaws love my big sphinx of quartz.')
                       ->feed('Pack my box with five dozen liquor jugs.')
                       ->feed('Sphinx of black quartz, judge my vow.')
                       ->feed('How vexingly quick daft zebras jump!')
                       ->feed('The five boxing wizards jump quickly.')
                       ->feed('Jackdaws love my big sphinx of quartz.')
                       ->feed('Pack my box with five dozen liquor jugs.')
                       ->calculate()
                       ->toArray();

    $expected = [
        'config' =>
            [
                'name' => 'Test Model',
                'n' => 2,
                'min_lenght' => 2,
                'unique' => false,
                'exclude_originals' => true,
                'frequency_precision' => 7,
                'number_of_sentence_elements' => 3,
                'tokenizer' =>
                    [
                        'word_filters' =>
                            [
                                0 =>
                                    [
                                        'pattern' => '/[^a-zéèëêęėēúüûùūçàáäâæãåāíïìîįīóöôòõœøōñńß]+/',
                                        'replacement' => '',
                                    ],
                            ],
                        'word_separation_patterns' =>
                            [
                                0 => '\\s',
                            ],
                        'sentence_separation_patterns' =>
                            [
                                0 => '.',
                                1 => '?',
                                2 => '!',
                                3 => ':',
                                4 => ';',
                                5 => '\\n',
                            ],
                        'to_lowercase' => true,
                    ],
            ],
        'data' =>
            [
                'elements' =>
                    [
                        'ab' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'bs',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'bs' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'ac' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ck',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ck' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ck',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'ck' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                            ],
                        'af' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ft',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ft' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'al' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'lt',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'lt' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ar' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'rd',
                                                1 => 'rt',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                                1 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                                1 => 6,
                                            ],
                                        'i' =>
                                            [
                                                'rd' => 0,
                                                'rt' => 1,
                                            ],
                                        'sw' => 6,
                                        'c' => 2,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'rf',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'rf' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'as' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'aw' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ws',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ws' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'az' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'zy',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'zy' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'bi' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ig',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ig' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'bl' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'la',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'la' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'bo' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ox',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ox' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ox',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ox' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'br' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ro',
                                                1 => 'ra',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                                1 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                                1 => 3,
                                            ],
                                        'i' =>
                                            [
                                                'ro' => 0,
                                                'ra' => 1,
                                            ],
                                        'sw' => 3,
                                        'c' => 2,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'bs' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ck' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'kl',
                                                1 => 'kd',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                                1 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                                1 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'kl' => 0,
                                                'kd' => 1,
                                            ],
                                        'sw' => 4,
                                        'c' => 2,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ks',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'ks' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'da' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'af',
                                                1 => 'aw',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                                1 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                                1 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'af' => 0,
                                                'aw' => 1,
                                            ],
                                        'sw' => 4,
                                        'c' => 2,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'dg' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ge',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ge' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'do' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'oz',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'oz' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'og',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'og' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'ds' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'dw' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'wa',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'wa' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'eb' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'br',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'br' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ed' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'en' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'er' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ex' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'xi',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'xi' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'fi' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'iv',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'iv' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'fo' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ox',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ox' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'ft' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ge' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'gl' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'li',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'li' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ly',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ly' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'gr' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ra',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'ra' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'gs' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'he' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'hi' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'in',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'in' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ho' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ow',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ow' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'ib' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ic' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ck',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ck' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ck',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'ck' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                            ],
                        'ig' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'in' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ng',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ng' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ng',
                                                1 => 'nx',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                                1 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                                1 => 6,
                                            ],
                                        'i' =>
                                            [
                                                'ng' => 0,
                                                'nx' => 1,
                                            ],
                                        'sw' => 6,
                                        'c' => 2,
                                    ],
                            ],
                        'iq' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'qu',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'qu' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'it' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'th',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'th' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'iv' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 've',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                've' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 've',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                've' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                            ],
                        'iz' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'za',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'za' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ja' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ac',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ac' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ji' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'iv',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'iv' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'jo' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'oc',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'oc' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ju' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ud',
                                                1 => 'ug',
                                                2 => 'um',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                                1 => 2,
                                                2 => 5,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                                1 => 4,
                                                2 => 9,
                                            ],
                                        'i' =>
                                            [
                                                'ud' => 0,
                                                'ug' => 1,
                                                'um' => 2,
                                            ],
                                        'sw' => 9,
                                        'c' => 3,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'kd' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'da',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'da' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'kl' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ly',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ly' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'ks' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'la' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'az',
                                                1 => 'ac',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                                1 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                                1 => 3,
                                            ],
                                        'i' =>
                                            [
                                                'az' => 0,
                                                'ac' => 1,
                                            ],
                                        'sw' => 3,
                                        'c' => 2,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'li' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'iq',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'iq' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ib',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'ib' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'lo' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ov',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ov' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'lt' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'tz',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'tz' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'ly' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'mp' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ps',
                                                1 => 'ph',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                                1 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                                1 => 3,
                                            ],
                                        'i' =>
                                            [
                                                'ps' => 0,
                                                'ph' => 1,
                                            ],
                                        'sw' => 3,
                                        'c' => 2,
                                    ],
                            ],
                        'my' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ng' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'gl',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'gl' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'nx' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ny' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ym',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ym' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'oc' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ck',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'ck' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'of' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'og' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'or' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ov' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 've',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                've' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 've',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                've' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'ow' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'wn',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'wn' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'ox' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'xi',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'xi' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'oz' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ze',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ze' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'pa' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ac',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ac' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ph' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'hi',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'hi' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ps' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'qu' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'uo',
                                                1 => 'ua',
                                                2 => 'ui',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                                1 => 4,
                                                2 => 7,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                                1 => 6,
                                                2 => 13,
                                            ],
                                        'i' =>
                                            [
                                                'uo' => 0,
                                                'ua' => 1,
                                                'ui' => 2,
                                            ],
                                        'sw' => 13,
                                        'c' => 3,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ra' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ab',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'ab' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'as',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'as' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'rd' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ds',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ds' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'rf' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ro' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ow',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'ow' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'rt' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'tz',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'tz' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                            ],
                        'sp' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ph',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'ph' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'th' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'he',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'he' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                            ],
                        'to' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'tz' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ua' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ar',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'ar' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ud' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'dg',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'dg' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ug' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'gs',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'gs' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'ui' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ic',
                                            ],
                                        'w' =>
                                            [
                                                0 => 6,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 6,
                                            ],
                                        'i' =>
                                            [
                                                'ic' => 0,
                                            ],
                                        'sw' => 6,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'iz',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'iz' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                            ],
                        'um' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'mp',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                            ],
                                        'i' =>
                                            [
                                                'mp' => 0,
                                            ],
                                        'sw' => 1,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'mp',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'mp' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                            ],
                        'uo' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'or',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'or' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        've' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ex',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ex' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'er',
                                                1 => 'ed',
                                                2 => 'ex',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                                1 => 1,
                                                2 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                                1 => 2,
                                                2 => 3,
                                            ],
                                        'i' =>
                                            [
                                                'er' => 0,
                                                'ed' => 1,
                                                'ex' => 2,
                                            ],
                                        'sw' => 3,
                                        'c' => 3,
                                    ],
                            ],
                        'vo' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ow',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ow' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'wa' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'al',
                                                1 => 'ar',
                                            ],
                                        'w' =>
                                            [
                                                0 => 1,
                                                1 => 1,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 1,
                                                1 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'al' => 0,
                                                'ar' => 1,
                                            ],
                                        'sw' => 2,
                                        'c' => 2,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'wi' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'iz',
                                                1 => 'it',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                                1 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                                1 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'iz' => 0,
                                                'it' => 1,
                                            ],
                                        'sw' => 4,
                                        'c' => 2,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'wn' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ws' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'xi' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'in',
                                            ],
                                        'w' =>
                                            [
                                                0 => 4,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 4,
                                            ],
                                        'i' =>
                                            [
                                                'in' => 0,
                                            ],
                                        'sw' => 4,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ym' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'mp',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'mp' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'za' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'ar',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'ar' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                        'ze' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'eb',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'eb' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                                0 => 'en',
                                            ],
                                        'w' =>
                                            [
                                                0 => 2,
                                            ],
                                        'cw' =>
                                            [
                                                0 => 2,
                                            ],
                                        'i' =>
                                            [
                                                'en' => 0,
                                            ],
                                        'sw' => 2,
                                        'c' => 1,
                                    ],
                            ],
                        'zy' =>
                            [
                                'c' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                                'lc' =>
                                    [
                                        'e' =>
                                            [
                                            ],
                                        'w' =>
                                            [
                                            ],
                                        'cw' =>
                                            [
                                            ],
                                        'i' =>
                                            [
                                            ],
                                        'sw' => 0,
                                        'c' => 0,
                                    ],
                            ],
                    ],
                'elements_count' => 97,
                'first_elements' =>
                    [
                        'e' =>
                            [
                                0 => 'br',
                                1 => 'ov',
                                2 => 'la',
                                3 => 'ji',
                                4 => 'gr',
                                5 => 'wa',
                                6 => 'gl',
                                7 => 'jo',
                                8 => 'to',
                                9 => 'dw',
                                10 => 'fo',
                                11 => 'ny',
                                12 => 'bl',
                                13 => 'vo',
                                14 => 'ho',
                                15 => 'da',
                                16 => 'ze',
                                17 => 'ja',
                                18 => 'lo',
                                19 => 'bi',
                                20 => 'pa',
                                21 => 'li',
                                22 => 'do',
                                23 => 've',
                                24 => 'th',
                                25 => 'sp',
                                26 => 'of',
                                27 => 'fi',
                                28 => 'bo',
                                29 => 'wi',
                                30 => 'my',
                                31 => 'ju',
                                32 => 'qu',
                            ],
                        'w' =>
                            [
                                0 => 1,
                                1 => 1,
                                2 => 1,
                                3 => 1,
                                4 => 1,
                                5 => 1,
                                6 => 1,
                                7 => 1,
                                8 => 1,
                                9 => 1,
                                10 => 2,
                                11 => 2,
                                12 => 2,
                                13 => 2,
                                14 => 2,
                                15 => 2,
                                16 => 2,
                                17 => 2,
                                18 => 2,
                                19 => 2,
                                20 => 2,
                                21 => 2,
                                22 => 3,
                                23 => 3,
                                24 => 4,
                                25 => 4,
                                26 => 4,
                                27 => 4,
                                28 => 4,
                                29 => 4,
                                30 => 6,
                                31 => 9,
                                32 => 11,
                            ],
                        'cw' =>
                            [
                                0 => 1,
                                1 => 2,
                                2 => 3,
                                3 => 4,
                                4 => 5,
                                5 => 6,
                                6 => 7,
                                7 => 8,
                                8 => 9,
                                9 => 10,
                                10 => 12,
                                11 => 14,
                                12 => 16,
                                13 => 18,
                                14 => 20,
                                15 => 22,
                                16 => 24,
                                17 => 26,
                                18 => 28,
                                19 => 30,
                                20 => 32,
                                21 => 34,
                                22 => 37,
                                23 => 40,
                                24 => 44,
                                25 => 48,
                                26 => 52,
                                27 => 56,
                                28 => 60,
                                29 => 64,
                                30 => 70,
                                31 => 79,
                                32 => 90,
                            ],
                        'i' =>
                            [
                                'br' => 0,
                                'ov' => 1,
                                'la' => 2,
                                'ji' => 3,
                                'gr' => 4,
                                'wa' => 5,
                                'gl' => 6,
                                'jo' => 7,
                                'to' => 8,
                                'dw' => 9,
                                'fo' => 10,
                                'ny' => 11,
                                'bl' => 12,
                                'vo' => 13,
                                'ho' => 14,
                                'da' => 15,
                                'ze' => 16,
                                'ja' => 17,
                                'lo' => 18,
                                'bi' => 19,
                                'pa' => 20,
                                'li' => 21,
                                'do' => 22,
                                've' => 23,
                                'th' => 24,
                                'sp' => 25,
                                'of' => 26,
                                'fi' => 27,
                                'bo' => 28,
                                'wi' => 29,
                                'my' => 30,
                                'ju' => 31,
                                'qu' => 32,
                            ],
                        'sw' => 90,
                        'c' => 33,
                    ],
                'sentence_elements' =>
                    [
                        3 =>
                            [
                                'e' =>
                                    [
                                        0 => 'br',
                                        1 => 'ny',
                                        2 => 'bl',
                                        3 => 'my',
                                        4 => 'qu',
                                        5 => 'bo',
                                    ],
                                'w' =>
                                    [
                                        0 => 1,
                                        1 => 1,
                                        2 => 2,
                                        3 => 2,
                                        4 => 3,
                                        5 => 4,
                                    ],
                                'cw' =>
                                    [
                                        0 => 1,
                                        1 => 2,
                                        2 => 4,
                                        3 => 6,
                                        4 => 9,
                                        5 => 13,
                                    ],
                                'i' =>
                                    [
                                        'br' => 0,
                                        'ny' => 1,
                                        'bl' => 2,
                                        'my' => 3,
                                        'qu' => 4,
                                        'bo' => 5,
                                    ],
                                'sw' => 13,
                                'c' => 6,
                            ],
                        2 =>
                            [
                                'e' =>
                                    [
                                        0 => 'qu',
                                        1 => 'fo',
                                        2 => 'jo',
                                        3 => 'of',
                                        4 => 've',
                                        5 => 'fi',
                                        6 => 'lo',
                                        7 => 'my',
                                    ],
                                'w' =>
                                    [
                                        0 => 1,
                                        1 => 1,
                                        2 => 1,
                                        3 => 2,
                                        4 => 2,
                                        5 => 2,
                                        6 => 2,
                                        7 => 2,
                                    ],
                                'cw' =>
                                    [
                                        0 => 1,
                                        1 => 2,
                                        2 => 3,
                                        3 => 5,
                                        4 => 7,
                                        5 => 9,
                                        6 => 11,
                                        7 => 13,
                                    ],
                                'i' =>
                                    [
                                        'qu' => 0,
                                        'fo' => 1,
                                        'jo' => 2,
                                        'of' => 3,
                                        've' => 4,
                                        'fi' => 5,
                                        'lo' => 6,
                                        'my' => 7,
                                    ],
                                'sw' => 13,
                                'c' => 8,
                            ],
                        1 =>
                            [
                                'e' =>
                                    [
                                        0 => 'ji',
                                        1 => 'gl',
                                        2 => 'sp',
                                        3 => 'ho',
                                        4 => 'ja',
                                        5 => 'pa',
                                        6 => 'th',
                                    ],
                                'w' =>
                                    [
                                        0 => 1,
                                        1 => 1,
                                        2 => 2,
                                        3 => 2,
                                        4 => 2,
                                        5 => 2,
                                        6 => 3,
                                    ],
                                'cw' =>
                                    [
                                        0 => 1,
                                        1 => 2,
                                        2 => 4,
                                        3 => 6,
                                        4 => 8,
                                        5 => 10,
                                        6 => 13,
                                    ],
                                'i' =>
                                    [
                                        'ji' => 0,
                                        'gl' => 1,
                                        'sp' => 2,
                                        'ho' => 3,
                                        'ja' => 4,
                                        'pa' => 5,
                                        'th' => 6,
                                    ],
                                'sw' => 13,
                                'c' => 7,
                            ],
                        -1 =>
                            [
                                'e' =>
                                    [
                                        0 => 'do',
                                        1 => 'wa',
                                        2 => 'dw',
                                        3 => 'vo',
                                        4 => 'ju',
                                        5 => 'qu',
                                    ],
                                'w' =>
                                    [
                                        0 => 1,
                                        1 => 1,
                                        2 => 1,
                                        3 => 2,
                                        4 => 4,
                                        5 => 4,
                                    ],
                                'cw' =>
                                    [
                                        0 => 1,
                                        1 => 2,
                                        2 => 3,
                                        3 => 5,
                                        4 => 9,
                                        5 => 13,
                                    ],
                                'i' =>
                                    [
                                        'do' => 0,
                                        'wa' => 1,
                                        'dw' => 2,
                                        'vo' => 3,
                                        'ju' => 4,
                                        'qu' => 5,
                                    ],
                                'sw' => 13,
                                'c' => 6,
                            ],
                        -2 =>
                            [
                                'e' =>
                                    [
                                        0 => 'la',
                                        1 => 'qu',
                                        2 => 've',
                                        3 => 'my',
                                        4 => 'ze',
                                        5 => 'ju',
                                        6 => 'of',
                                        7 => 'li',
                                    ],
                                'w' =>
                                    [
                                        0 => 1,
                                        1 => 1,
                                        2 => 1,
                                        3 => 2,
                                        4 => 2,
                                        5 => 2,
                                        6 => 2,
                                        7 => 2,
                                    ],
                                'cw' =>
                                    [
                                        0 => 1,
                                        1 => 2,
                                        2 => 3,
                                        3 => 5,
                                        4 => 7,
                                        5 => 9,
                                        6 => 11,
                                        7 => 13,
                                    ],
                                'i' =>
                                    [
                                        'la' => 0,
                                        'qu' => 1,
                                        've' => 2,
                                        'my' => 3,
                                        'ze' => 4,
                                        'ju' => 5,
                                        'of' => 6,
                                        'li' => 7,
                                    ],
                                'sw' => 13,
                                'c' => 8,
                            ],
                        -3 =>
                            [
                                'e' =>
                                    [
                                        0 => 'th',
                                        1 => 'gr',
                                        2 => 'to',
                                        3 => 'ju',
                                        4 => 'da',
                                        5 => 'wi',
                                        6 => 'sp',
                                        7 => 'do',
                                    ],
                                'w' =>
                                    [
                                        0 => 1,
                                        1 => 1,
                                        2 => 1,
                                        3 => 2,
                                        4 => 2,
                                        5 => 2,
                                        6 => 2,
                                        7 => 2,
                                    ],
                                'cw' =>
                                    [
                                        0 => 1,
                                        1 => 2,
                                        2 => 3,
                                        3 => 5,
                                        4 => 7,
                                        5 => 9,
                                        6 => 11,
                                        7 => 13,
                                    ],
                                'i' =>
                                    [
                                        'th' => 0,
                                        'gr' => 1,
                                        'to' => 2,
                                        'ju' => 3,
                                        'da' => 4,
                                        'wi' => 5,
                                        'sp' => 6,
                                        'do' => 7,
                                    ],
                                'sw' => 13,
                                'c' => 8,
                            ],
                    ],
                'word_lengths' =>
                    [
                        'e' =>
                            [
                                0 => 8,
                                1 => 7,
                                2 => 2,
                                3 => 6,
                                4 => 3,
                                5 => 5,
                                6 => 4,
                            ],
                        'w' =>
                            [
                                0 => 4,
                                1 => 4,
                                2 => 11,
                                3 => 14,
                                4 => 16,
                                5 => 19,
                                6 => 22,
                            ],
                        'cw' =>
                            [
                                0 => 4,
                                1 => 8,
                                2 => 19,
                                3 => 33,
                                4 => 49,
                                5 => 68,
                                6 => 90,
                            ],
                        'i' =>
                            [
                                8 => 0,
                                7 => 1,
                                2 => 2,
                                6 => 3,
                                3 => 4,
                                5 => 5,
                                4 => 6,
                            ],
                        'sw' => 90,
                        'c' => 7,
                    ],
                'sentence_lengths' =>
                    [
                        'e' =>
                            [
                                0 => 9,
                                1 => 8,
                                2 => 6,
                                3 => 7,
                            ],
                        'w' =>
                            [
                                0 => 1,
                                1 => 2,
                                2 => 5,
                                3 => 5,
                            ],
                        'cw' =>
                            [
                                0 => 1,
                                1 => 3,
                                2 => 8,
                                3 => 13,
                            ],
                        'i' =>
                            [
                                9 => 0,
                                8 => 1,
                                6 => 2,
                                7 => 3,
                            ],
                        'sw' => 13,
                        'c' => 4,
                    ],
            ],
        'excluded' =>
            [
                'words' =>
                    [
                        0 => 'big',
                        1 => 'black',
                        2 => 'box',
                        3 => 'boxing',
                        4 => 'brown',
                        5 => 'daft',
                        6 => 'dog',
                        7 => 'dozen',
                        8 => 'dwarf',
                        9 => 'five',
                        10 => 'fox',
                        11 => 'glib',
                        12 => 'grabs',
                        13 => 'how',
                        14 => 'jackdaws',
                        15 => 'jived',
                        16 => 'jocks',
                        17 => 'judge',
                        18 => 'jugs',
                        19 => 'jump',
                        20 => 'jumps',
                        21 => 'lazy',
                        22 => 'liquor',
                        23 => 'love',
                        24 => 'my',
                        25 => 'nymph',
                        26 => 'of',
                        27 => 'over',
                        28 => 'pack',
                        29 => 'quartz',
                        30 => 'quick',
                        31 => 'quickly',
                        32 => 'quiz',
                        33 => 'sphinx',
                        34 => 'the',
                        35 => 'to',
                        36 => 'vex',
                        37 => 'vexingly',
                        38 => 'vow',
                        39 => 'waltz',
                        40 => 'with',
                        41 => 'wizards',
                        42 => 'zebras',
                    ],
                'count' => 43,
            ],
    ];

    expect($modelData)->toBe($expected);
});
