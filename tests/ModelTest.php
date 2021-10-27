<?php

declare(strict_types=1);

use Phonyland\LanguageModel\Model;
use Phonyland\NGram\TokenizerFilter;

test('N-Gram Model', function (): void {
    $model = new Model('Test Model');

    $model->config->n(2)
                  ->minLenght(2)
                  ->unique(false)
                  ->excludeOriginals(false)
                  ->frequencyPrecision(7)
        ->tokenizer->addWordSeparatorPattern(TokenizerFilter::WHITESPACE_SEPARATOR)
                   ->addWordFilterRule(TokenizerFilter::LATIN_EXTENDED_ALPHABETICAL)
                   ->addSentenceSeparatorPattern(['.', '?', '!', ':', ';', '\n'])
                   ->toLowercase();

    /** @var string $text */
    $text = file_get_contents('./tests/stubs/test.txt');

    $model = $model->build($text);
    $expected = [
        'config' => [
                'name'                => 'Test Model',
                'n'                   => 2,
                'min_lenght'          => 2,
                'unique'              => false,
                'exclude_originals'   => false,
                'frequency_precision' => 7,
                'limits'              => [
                        'elements'                            => 500,
                        'first_elements'                      => 500,
                        'first_element_of_sentence'           => 500,
                        'second_element_of_sentence'          => 500,
                        'third_element_of_sentence'           => 500,
                        'last_element_of_sentence'            => 500,
                        'second_to_last_element_of_sentence'  => 500,
                        'third_to_last_element_of_sentence'   => 500,
                    ],
                'tokenizer'           => [
                        'word_filters'                 => [
                                [
                                    'pattern'     => '/[^a-zéèëêęėēúüûùūçàáäâæãåāíïìîįīóöôòõœøōñńß]+/',
                                    'replacement' => '',
                                ],
                            ],
                        'word_separation_patterns'     => ['\s'],
                        'sentence_separation_patterns' => ['.', '?', '!', ':', ';', '\n'],
                        'to_lowercase'                 => true,
                    ],
            ],
        'data'   => [
                'elements'                           => [
                        'th' => [
                                0,
                                ['he' => 1],
                            ],
                        'he' => [0, 0],
                        'qu' => [
                                ['ui' => 1],
                                0,
                            ],
                        'ui' => [
                                ['ic' => 1],
                                0,
                            ],
                        'ic' => [
                                0,
                                ['ck' => 1],
                            ],
                        'ck' => [0, 0],
                        'br' => [
                                ['ro' => 1],
                                0,
                            ],
                        'ro' => [
                                ['ow' => 1],
                                0,
                            ],
                        'ow' => [
                                0,
                                ['wn' => 1],
                            ],
                        'wn' => [0, 0],
                        'fo' => [
                                0 => 0,
                                1 => ['ox' => 1],
                            ],
                        'ox' => [0, 0],
                        'ju' => [
                                ['um' => 1],
                                0,
                            ],
                        'um' => [
                                ['mp' => 1],
                                0,
                            ],
                        'mp' => [
                                0,
                                ['ps' => 1],
                            ],
                        'ps' => [0, 0],
                        'ov' => [
                                ['ve' => 1],
                                0,
                            ],
                        've' => [
                                0,
                                ['er' => 1],
                            ],
                        'er' => [0, 0],
                        'la' => [
                                ['az' => 1],
                                0,
                            ],
                        'az' => [
                                0,
                                ['zy' => 1],
                            ],
                        'zy' => [0, 0],
                        'do' => [
                                0,
                                ['og' => 1],
                            ],
                        'og' => [0, 0],
                    ],
                'first_elements'                     => [
                        'th' => 0.2222222222222222,
                        'qu' => 0.1111111111111111,
                        'br' => 0.1111111111111111,
                        'fo' => 0.1111111111111111,
                        'ju' => 0.1111111111111111,
                        'ov' => 0.1111111111111111,
                        'la' => 0.1111111111111111,
                        'do' => 0.1111111111111111,
                    ],
                'first_element_of_sentence'          => ['th' => 1],
                'second_element_of_sentence'         => ['qu' => 1],
                'third_element_of_sentence'          => ['br' => 1],
                'last_element_of_sentence'           => ['do' => 1],
                'second_to_last_element_of_sentence' => ['la' => 1],
                'third_to_last_element_of_sentence'  => ['th' => 1],
                'excluded'                           => [],
            ],
    ];

    expect($model)->toBe($expected);
});
