<?php

declare(strict_types=1);

use Phonyland\LanguageModel\Model;
use Phonyland\NGram\TokenizerFilter;

test('Model can be build', function (): void {
    $model = new Model('Test Model');

    $model->config->n(2)
                  ->minLenght(2)
                  ->unique(false)
                  ->excludeOriginals(true)
                  ->frequencyPrecision(7)
                  ->tokenizer->addWordSeparatorPattern(TokenizerFilter::WHITESPACE_SEPARATOR)
                              ->addWordFilterRule(TokenizerFilter::LATIN_EXTENDED_ALPHABETICAL)
                              ->addSentenceSeparatorPattern(['.', '?', '!', ':', ';', '\n'])
                              ->toLowercase();

    $model->feed('The quick brown fox jumps over the lazy dog.');
    $model->feed('Pack my box with five dozen liquor jugs.');

    $model = $model->build();
    $expected = [
        'config' => [
                'name'                => 'Test Model',
                'n'                   => 2,
                'min_lenght'          => 2,
                'unique'              => false,
                'exclude_originals'   => true,
                'frequency_precision' => 7,
                'limits'              => [
                        'elements'                           => 500,
                        'first_elements'                     => 500,
                        'first_element_of_sentence'          => 500,
                        'second_element_of_sentence'         => 500,
                        'third_element_of_sentence'          => 500,
                        'last_element_of_sentence'           => 500,
                        'second_to_last_element_of_sentence' => 500,
                        'third_to_last_element_of_sentence'  => 500,
                    ],
                'tokenizer' => [
                        'word_filters' => [
                                0 => [
                                        'pattern'     => '/[^a-zéèëêęėēúüûùūçàáäâæãåāíïìîįīóöôòõœøōñńß]+/',
                                        'replacement' => '',
                                    ],
                            ],
                        'word_separation_patterns' => [
                                0 => '\\s',
                            ],
                        'sentence_separation_patterns' => [
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
        'data' => [
                'elements' => [
                        'th' => [
                                0 => 0,
                                1 => [
                                        'he' => 1,
                                    ],
                            ],
                        'he' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'qu' => [
                                0 => [
                                        'ui' => 0.5,
                                        'uo' => 0.5,
                                    ],
                                1 => 0,
                            ],
                        'ui' => [
                                0 => [
                                        'ic' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ic' => [
                                0 => 0,
                                1 => [
                                        'ck' => 1,
                                    ],
                            ],
                        'ck' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'br' => [
                                0 => [
                                        'ro' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ro' => [
                                0 => [
                                        'ow' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ow' => [
                                0 => 0,
                                1 => [
                                        'wn' => 1,
                                    ],
                            ],
                        'wn' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'fo' => [
                                0 => 0,
                                1 => [
                                        'ox' => 1,
                                    ],
                            ],
                        'ox' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'ju' => [
                                0 => [
                                        'um' => 0.5,
                                        'ug' => 0.5,
                                    ],
                                1 => 0,
                            ],
                        'um' => [
                                0 => [
                                        'mp' => 1,
                                    ],
                                1 => 0,
                            ],
                        'mp' => [
                                0 => 0,
                                1 => [
                                        'ps' => 1,
                                    ],
                            ],
                        'ps' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'ov' => [
                                0 => [
                                        've' => 1,
                                    ],
                                1 => 0,
                            ],
                        've' => [
                                0 => 0,
                                1 => [
                                        'er' => 1,
                                    ],
                            ],
                        'er' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'la' => [
                                0 => [
                                        'az' => 1,
                                    ],
                                1 => 0,
                            ],
                        'az' => [
                                0 => 0,
                                1 => [
                                        'zy' => 1,
                                    ],
                            ],
                        'zy' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'do' => [
                                0 => [
                                        'oz' => 1,
                                    ],
                                1 => [
                                        'og' => 1,
                                    ],
                            ],
                        'og' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'pa' => [
                                0 => [
                                        'ac' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ac' => [
                                0 => 0,
                                1 => [
                                        'ck' => 1,
                                    ],
                            ],
                        'my' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'bo' => [
                                0 => 0,
                                1 => [
                                        'ox' => 1,
                                    ],
                            ],
                        'wi' => [
                                0 => [
                                        'it' => 1,
                                    ],
                                1 => 0,
                            ],
                        'it' => [
                                0 => 0,
                                1 => [
                                        'th' => 1,
                                    ],
                            ],
                        'fi' => [
                                0 => [
                                        'iv' => 1,
                                    ],
                                1 => 0,
                            ],
                        'iv' => [
                                0 => 0,
                                1 => [
                                        've' => 1,
                                    ],
                            ],
                        'oz' => [
                                0 => [
                                        'ze' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ze' => [
                                0 => 0,
                                1 => [
                                        'en' => 1,
                                    ],
                            ],
                        'en' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'li' => [
                                0 => [
                                        'iq' => 1,
                                    ],
                                1 => 0,
                            ],
                        'iq' => [
                                0 => [
                                        'qu' => 1,
                                    ],
                                1 => 0,
                            ],
                        'uo' => [
                                0 => 0,
                                1 => [
                                        'or' => 1,
                                    ],
                            ],
                        'or' => [
                                0 => 0,
                                1 => 0,
                            ],
                        'ug' => [
                                0 => 0,
                                1 => [
                                        'gs' => 1,
                                    ],
                            ],
                        'gs' => [
                                0 => 0,
                                1 => 0,
                            ],
                    ],
                'first_elements' => [
                        'th' => 0.11764705882352941,
                        'qu' => 0.058823529411764705,
                        'br' => 0.058823529411764705,
                        'fo' => 0.058823529411764705,
                        'ju' => 0.11764705882352941,
                        'ov' => 0.058823529411764705,
                        'la' => 0.058823529411764705,
                        'do' => 0.11764705882352941,
                        'pa' => 0.058823529411764705,
                        'my' => 0.058823529411764705,
                        'bo' => 0.058823529411764705,
                        'wi' => 0.058823529411764705,
                        'fi' => 0.058823529411764705,
                        'li' => 0.058823529411764705,
                    ],
                'first_element_of_sentence' => [
                        'th' => 0.5,
                        'pa' => 0.5,
                    ],
                'second_element_of_sentence' => [
                        'qu' => 0.5,
                        'my' => 0.5,
                    ],
                'third_element_of_sentence' => [
                        'br' => 0.5,
                        'bo' => 0.5,
                    ],
                'last_element_of_sentence' => [
                        'do' => 0.5,
                        'ju' => 0.5,
                    ],
                'second_to_last_element_of_sentence' => [
                        'la' => 0.5,
                        'li' => 0.5,
                    ],
                'third_to_last_element_of_sentence' => [
                        'th' => 0.5,
                        'do' => 0.5,
                    ],
            ],
        'excluded' => [
                0  => 'the',
                1  => 'quick',
                2  => 'brown',
                3  => 'fox',
                4  => 'jumps',
                5  => 'over',
                6  => 'the',
                7  => 'lazy',
                8  => 'dog',
                9  => 'pack',
                10 => 'my',
                11 => 'box',
                12 => 'with',
                13 => 'five',
                14 => 'dozen',
                15 => 'liquor',
                16 => 'jugs',
            ],
    ];

    expect($model)->toBe($expected);
});
