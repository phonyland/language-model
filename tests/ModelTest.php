<?php

declare(strict_types=1);

use Phonyland\LanguageModel\Model;
use Phonyland\NGram\Tokenizer;
use Phonyland\NGram\TokenizerFilterType;

test('A Phony Model can be build', function (): void {
    $model = new Model('Test Model');

    $model->config->nGramSize(4)
        ->minWordLength(4)
        ->excludeOriginals(true)
        ->numberOfSentenceElements(2)
        ->tokenizer(
            (new Tokenizer())
                ->addWordSeparatorPattern(TokenizerFilterType::WHITESPACE_SEPARATOR)
                ->addWordFilterRule(TokenizerFilterType::ALPHANUMBERICAL)
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
        'config' => [
            'name' => 'Test Model',
            'n_gram_size' => 4,
            'min_word_length' => 4,
            'exclude_originals' => true,
            'number_of_sentence_elements' => 2,
            'tokenizer' => [
                'word_filters' => [
                    0 => [
                        'pattern' => '/[^0-9a-z]+/',
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
                'ackd' => [
                    'c' => [
                        'e' => [
                            0 => 'ckda',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ckda' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'altz' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'ards' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'artz' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'blac' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'lack',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'lack' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'boxi' => [
                    'c' => [
                        'e' => [
                            0 => 'oxin',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'oxin' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'bras' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'brow' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'rown',
                        ],
                        'w' => [
                            0 => 1,
                        ],
                        'cw' => [
                            0 => 1,
                        ],
                        'i' => [
                            'rown' => 0,
                        ],
                        'sw' => 1,
                        'c' => 1,
                    ],
                ],
                'ckda' => [
                    'c' => [
                        'e' => [
                            0 => 'kdaw',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'kdaw' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'ckly' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'daft' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'daws' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'doze' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'ozen',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ozen' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'dwar' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'warf',
                        ],
                        'w' => [
                            0 => 1,
                        ],
                        'cw' => [
                            0 => 1,
                        ],
                        'i' => [
                            'warf' => 0,
                        ],
                        'sw' => 1,
                        'c' => 1,
                    ],
                ],
                'ebra' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'bras',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'bras' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'exin' => [
                    'c' => [
                        'e' => [
                            0 => 'xing',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'xing' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'five' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'glib' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'grab' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'rabs',
                        ],
                        'w' => [
                            0 => 1,
                        ],
                        'cw' => [
                            0 => 1,
                        ],
                        'i' => [
                            'rabs' => 0,
                        ],
                        'sw' => 1,
                        'c' => 1,
                    ],
                ],
                'hinx' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'ickl' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'ckly',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ckly' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'ingl' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'ngly',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ngly' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'iquo' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'quor',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'quor' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'ived' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'izar' => [
                    'c' => [
                        'e' => [
                            0 => 'zard',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'zard' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'jack' => [
                    'c' => [
                        'e' => [
                            0 => 'ackd',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ackd' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'jive' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'ived',
                        ],
                        'w' => [
                            0 => 1,
                        ],
                        'cw' => [
                            0 => 1,
                        ],
                        'i' => [
                            'ived' => 0,
                        ],
                        'sw' => 1,
                        'c' => 1,
                    ],
                ],
                'jock' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'ocks',
                        ],
                        'w' => [
                            0 => 1,
                        ],
                        'cw' => [
                            0 => 1,
                        ],
                        'i' => [
                            'ocks' => 0,
                        ],
                        'sw' => 1,
                        'c' => 1,
                    ],
                ],
                'judg' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'udge',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'udge' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'jugs' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'jump' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'umps',
                        ],
                        'w' => [
                            0 => 1,
                        ],
                        'cw' => [
                            0 => 1,
                        ],
                        'i' => [
                            'umps' => 0,
                        ],
                        'sw' => 1,
                        'c' => 1,
                    ],
                ],
                'kdaw' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'daws',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'daws' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'lack' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'lazy' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'liqu' => [
                    'c' => [
                        'e' => [
                            0 => 'iquo',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'iquo' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'love' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'ngly' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'nymp' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'ymph',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ymph' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'ocks' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'over' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'oxin' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'xing',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'xing' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'ozen' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'pack' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'phin' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'hinx',
                        ],
                        'w' => [
                            0 => 4,
                        ],
                        'cw' => [
                            0 => 4,
                        ],
                        'i' => [
                            'hinx' => 0,
                        ],
                        'sw' => 4,
                        'c' => 1,
                    ],
                ],
                'quar' => [
                    'c' => [
                        'e' => [
                            0 => 'uart',
                        ],
                        'w' => [
                            0 => 4,
                        ],
                        'cw' => [
                            0 => 4,
                        ],
                        'i' => [
                            'uart' => 0,
                        ],
                        'sw' => 4,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'quic' => [
                    'c' => [
                        'e' => [
                            0 => 'uick',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'uick' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'uick',
                        ],
                        'w' => [
                            0 => 4,
                        ],
                        'cw' => [
                            0 => 4,
                        ],
                        'i' => [
                            'uick' => 0,
                        ],
                        'sw' => 4,
                        'c' => 1,
                    ],
                ],
                'quiz' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'quor' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'rabs' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'rown' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'sphi' => [
                    'c' => [
                        'e' => [
                            0 => 'phin',
                        ],
                        'w' => [
                            0 => 4,
                        ],
                        'cw' => [
                            0 => 4,
                        ],
                        'i' => [
                            'phin' => 0,
                        ],
                        'sw' => 4,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'uart' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'artz',
                        ],
                        'w' => [
                            0 => 4,
                        ],
                        'cw' => [
                            0 => 4,
                        ],
                        'i' => [
                            'artz' => 0,
                        ],
                        'sw' => 4,
                        'c' => 1,
                    ],
                ],
                'udge' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'uick' => [
                    'c' => [
                        'e' => [
                            0 => 'ickl',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ickl' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'umps' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'vexi' => [
                    'c' => [
                        'e' => [
                            0 => 'exin',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'exin' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'walt' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'altz',
                        ],
                        'w' => [
                            0 => 1,
                        ],
                        'cw' => [
                            0 => 1,
                        ],
                        'i' => [
                            'altz' => 0,
                        ],
                        'sw' => 1,
                        'c' => 1,
                    ],
                ],
                'warf' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'with' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'wiza' => [
                    'c' => [
                        'e' => [
                            0 => 'izar',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'izar' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'xing' => [
                    'c' => [
                        'e' => [
                            0 => 'ingl',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ingl' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'ymph' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
                'zard' => [
                    'c' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                    'lc' => [
                        'e' => [
                            0 => 'ards',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ards' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                ],
                'zebr' => [
                    'c' => [
                        'e' => [
                            0 => 'ebra',
                        ],
                        'w' => [
                            0 => 2,
                        ],
                        'cw' => [
                            0 => 2,
                        ],
                        'i' => [
                            'ebra' => 0,
                        ],
                        'sw' => 2,
                        'c' => 1,
                    ],
                    'lc' => [
                        'e' => [
                        ],
                        'w' => [
                        ],
                        'cw' => [
                        ],
                        'i' => [
                        ],
                        'sw' => 0,
                        'c' => 0,
                    ],
                ],
            ],
            'elements_count' => 64,
            'first_elements' => [
                'e' => [
                    0 => 'brow',
                    1 => 'over',
                    2 => 'lazy',
                    3 => 'jive',
                    4 => 'grab',
                    5 => 'walt',
                    6 => 'glib',
                    7 => 'jock',
                    8 => 'quiz',
                    9 => 'dwar',
                    10 => 'nymp',
                    11 => 'blac',
                    12 => 'judg',
                    13 => 'vexi',
                    14 => 'daft',
                    15 => 'zebr',
                    16 => 'boxi',
                    17 => 'wiza',
                    18 => 'jack',
                    19 => 'love',
                    20 => 'pack',
                    21 => 'with',
                    22 => 'doze',
                    23 => 'liqu',
                    24 => 'jugs',
                    25 => 'sphi',
                    26 => 'quar',
                    27 => 'five',
                    28 => 'jump',
                    29 => 'quic',
                ],
                'w' => [
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
                    22 => 2,
                    23 => 2,
                    24 => 2,
                    25 => 4,
                    26 => 4,
                    27 => 4,
                    28 => 5,
                    29 => 6,
                ],
                'cw' => [
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
                    22 => 36,
                    23 => 38,
                    24 => 40,
                    25 => 44,
                    26 => 48,
                    27 => 52,
                    28 => 57,
                    29 => 63,
                ],
                'i' => [
                    'brow' => 0,
                    'over' => 1,
                    'lazy' => 2,
                    'jive' => 3,
                    'grab' => 4,
                    'walt' => 5,
                    'glib' => 6,
                    'jock' => 7,
                    'quiz' => 8,
                    'dwar' => 9,
                    'nymp' => 10,
                    'blac' => 11,
                    'judg' => 12,
                    'vexi' => 13,
                    'daft' => 14,
                    'zebr' => 15,
                    'boxi' => 16,
                    'wiza' => 17,
                    'jack' => 18,
                    'love' => 19,
                    'pack' => 20,
                    'with' => 21,
                    'doze' => 22,
                    'liqu' => 23,
                    'jugs' => 24,
                    'sphi' => 25,
                    'quar' => 26,
                    'five' => 27,
                    'jump' => 28,
                    'quic' => 29,
                ],
                'sw' => 63,
                'c' => 30,
            ],
            'sentence_elements' => [
                2 => [
                    'e' => [
                        0 => 'brow',
                        1 => 'nymp',
                        2 => 'jock',
                        3 => 'blac',
                        4 => 'quic',
                        5 => 'boxi',
                        6 => 'love',
                        7 => 'with',
                    ],
                    'w' => [
                        0 => 1,
                        1 => 1,
                        2 => 1,
                        3 => 2,
                        4 => 2,
                        5 => 2,
                        6 => 2,
                        7 => 2,
                    ],
                    'cw' => [
                        0 => 1,
                        1 => 2,
                        2 => 3,
                        3 => 5,
                        4 => 7,
                        5 => 9,
                        6 => 11,
                        7 => 13,
                    ],
                    'i' => [
                        'brow' => 0,
                        'nymp' => 1,
                        'jock' => 2,
                        'blac' => 3,
                        'quic' => 4,
                        'boxi' => 5,
                        'love' => 6,
                        'with' => 7,
                    ],
                    'sw' => 13,
                    'c' => 8,
                ],
                1 => [
                    'e' => [
                        0 => 'quic',
                        1 => 'jive',
                        2 => 'glib',
                        3 => 'sphi',
                        4 => 'vexi',
                        5 => 'five',
                        6 => 'jack',
                        7 => 'pack',
                    ],
                    'w' => [
                        0 => 1,
                        1 => 1,
                        2 => 1,
                        3 => 2,
                        4 => 2,
                        5 => 2,
                        6 => 2,
                        7 => 2,
                    ],
                    'cw' => [
                        0 => 1,
                        1 => 2,
                        2 => 3,
                        3 => 5,
                        4 => 7,
                        5 => 9,
                        6 => 11,
                        7 => 13,
                    ],
                    'i' => [
                        'quic' => 0,
                        'jive' => 1,
                        'glib' => 2,
                        'sphi' => 3,
                        'vexi' => 4,
                        'five' => 5,
                        'jack' => 6,
                        'pack' => 7,
                    ],
                    'sw' => 13,
                    'c' => 8,
                ],
                -1 => [
                    'e' => [
                        0 => 'lazy',
                        1 => 'walt',
                        2 => 'dwar',
                        3 => 'judg',
                        4 => 'jump',
                        5 => 'quic',
                        6 => 'quar',
                        7 => 'jugs',
                    ],
                    'w' => [
                        0 => 1,
                        1 => 1,
                        2 => 1,
                        3 => 2,
                        4 => 2,
                        5 => 2,
                        6 => 2,
                        7 => 2,
                    ],
                    'cw' => [
                        0 => 1,
                        1 => 2,
                        2 => 3,
                        3 => 5,
                        4 => 7,
                        5 => 9,
                        6 => 11,
                        7 => 13,
                    ],
                    'i' => [
                        'lazy' => 0,
                        'walt' => 1,
                        'dwar' => 2,
                        'judg' => 3,
                        'jump' => 4,
                        'quic' => 5,
                        'quar' => 6,
                        'jugs' => 7,
                    ],
                    'sw' => 13,
                    'c' => 8,
                ],
                -2 => [
                    'e' => [
                        0 => 'over',
                        1 => 'quic',
                        2 => 'nymp',
                        3 => 'quar',
                        4 => 'zebr',
                        5 => 'jump',
                        6 => 'sphi',
                        7 => 'liqu',
                    ],
                    'w' => [
                        0 => 1,
                        1 => 1,
                        2 => 1,
                        3 => 2,
                        4 => 2,
                        5 => 2,
                        6 => 2,
                        7 => 2,
                    ],
                    'cw' => [
                        0 => 1,
                        1 => 2,
                        2 => 3,
                        3 => 5,
                        4 => 7,
                        5 => 9,
                        6 => 11,
                        7 => 13,
                    ],
                    'i' => [
                        'over' => 0,
                        'quic' => 1,
                        'nymp' => 2,
                        'quar' => 3,
                        'zebr' => 4,
                        'jump' => 5,
                        'sphi' => 6,
                        'liqu' => 7,
                    ],
                    'sw' => 13,
                    'c' => 8,
                ],
            ],
            'word_lengths' => [
                'e' => [
                    0 => 8,
                    1 => 7,
                    2 => 6,
                    3 => 5,
                    4 => 4,
                ],
                'w' => [
                    0 => 4,
                    1 => 4,
                    2 => 14,
                    3 => 19,
                    4 => 22,
                ],
                'cw' => [
                    0 => 4,
                    1 => 8,
                    2 => 22,
                    3 => 41,
                    4 => 63,
                ],
                'i' => [
                    8 => 0,
                    7 => 1,
                    6 => 2,
                    5 => 3,
                    4 => 4,
                ],
                'sw' => 63,
                'c' => 5,
            ],
            'sentence_lengths' => [
                'e' => [
                    0 => 6,
                    1 => 4,
                    2 => 5,
                ],
                'w' => [
                    0 => 2,
                    1 => 4,
                    2 => 7,
                ],
                'cw' => [
                    0 => 2,
                    1 => 6,
                    2 => 13,
                ],
                'i' => [
                    6 => 0,
                    4 => 1,
                    5 => 2,
                ],
                'sw' => 13,
                'c' => 3,
            ],
        ],
        'excluded' => [
            'words' => [
                0 => 'black',
                1 => 'boxing',
                2 => 'brown',
                3 => 'daft',
                4 => 'dozen',
                5 => 'dwarf',
                6 => 'five',
                7 => 'glib',
                8 => 'grabs',
                9 => 'jackdaws',
                10 => 'jived',
                11 => 'jocks',
                12 => 'judge',
                13 => 'jugs',
                14 => 'jump',
                15 => 'jumps',
                16 => 'lazy',
                17 => 'liquor',
                18 => 'love',
                19 => 'nymph',
                20 => 'over',
                21 => 'pack',
                22 => 'quartz',
                23 => 'quick',
                24 => 'quickly',
                25 => 'quiz',
                26 => 'sphinx',
                27 => 'vexingly',
                28 => 'waltz',
                29 => 'with',
                30 => 'wizards',
                31 => 'zebras',
            ],
            'count' => 32,
        ],
    ];

    expect($modelData)->toBe($expected);
});
