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
                       ->calculate()
                       ->toArray();

    $expected = [
        'config' => [
                'name'                        => 'Test Model',
                'n'                           => 2,
                'min_lenght'                  => 2,
                'unique'                      => false,
                'exclude_originals'           => true,
                'frequency_precision'         => 7,
                'number_of_sentence_elements' => 3,
                'tokenizer'                   => [
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
                        'ab' => [
                                'lc' => [
                                        'bs' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'ac' => [
                                'c' => [
                                        'ck' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'ck' => 2,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 2,
                            ],
                        'af' => [
                                'lc' => [
                                        'ft' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'al' => [
                                'c' => [
                                        'lt' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'ar' => [
                                'c' => [
                                        'rt' => 2,
                                        'rd' => 1,
                                    ],
                                'cc'  => 2,
                                'cwc' => 3,
                                'lc'  => [
                                        'rf' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'as' => [
                            ],
                        'aw' => [
                                'lc' => [
                                        'ws' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'az' => [
                                'lc' => [
                                        'zy' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'bi' => [
                                'lc' => [
                                        'ig' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'bl' => [
                                'c' => [
                                        'la' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'bo' => [
                                'c' => [
                                        'ox' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'ox' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'br' => [
                                'c' => [
                                        'ro' => 1,
                                        'ra' => 1,
                                    ],
                                'cc'  => 2,
                                'cwc' => 2,
                            ],
                        'bs' => [
                            ],
                        'ck' => [
                                'c' => [
                                        'kl' => 1,
                                        'kd' => 1,
                                    ],
                                'cc'  => 2,
                                'cwc' => 2,
                                'lc'  => [
                                        'ks' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'da' => [
                                'c' => [
                                        'af' => 1,
                                        'aw' => 1,
                                    ],
                                'cc'  => 2,
                                'cwc' => 2,
                            ],
                        'dg' => [
                                'lc' => [
                                        'ge' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'do' => [
                                'c' => [
                                        'oz' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'og' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'ds' => [
                            ],
                        'dw' => [
                                'c' => [
                                        'wa' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'eb' => [
                                'c' => [
                                        'br' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'ed' => [
                            ],
                        'en' => [
                            ],
                        'er' => [
                            ],
                        'ex' => [
                                'c' => [
                                        'xi' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'fi' => [
                                'c' => [
                                        'iv' => 2,
                                    ],
                                'cc'  => 1,
                                'cwc' => 2,
                            ],
                        'fo' => [
                                'lc' => [
                                        'ox' => 2,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 2,
                            ],
                        'ft' => [
                            ],
                        'ge' => [
                            ],
                        'gl' => [
                                'c' => [
                                        'li' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'ly' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'gr' => [
                                'c' => [
                                        'ra' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'gs' => [
                            ],
                        'he' => [
                            ],
                        'hi' => [
                                'c' => [
                                        'in' => 2,
                                    ],
                                'cc'  => 1,
                                'cwc' => 2,
                            ],
                        'ho' => [
                                'lc' => [
                                        'ow' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'ib' => [
                            ],
                        'ic' => [
                                'c' => [
                                        'ck' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'ck' => 3,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 3,
                            ],
                        'ig' => [
                            ],
                        'in' => [
                                'c' => [
                                        'ng' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'nx' => 2,
                                        'ng' => 1,
                                    ],
                                'lcc'  => 2,
                                'lcwc' => 3,
                            ],
                        'iq' => [
                                'c' => [
                                        'qu' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'it' => [
                                'lc' => [
                                        'th' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'iv' => [
                                'c' => [
                                        've' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        've' => 2,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 2,
                            ],
                        'iz' => [
                                'c' => [
                                        'za' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'ja' => [
                                'c' => [
                                        'ac' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'ji' => [
                                'c' => [
                                        'iv' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'jo' => [
                                'c' => [
                                        'oc' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'ju' => [
                                'c' => [
                                        'um' => 3,
                                        'ud' => 1,
                                        'ug' => 1,
                                    ],
                                'cc'  => 3,
                                'cwc' => 5,
                            ],
                        'kd' => [
                                'c' => [
                                        'da' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'kl' => [
                                'lc' => [
                                        'ly' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'ks' => [
                            ],
                        'la' => [
                                'c' => [
                                        'az' => 1,
                                        'ac' => 1,
                                    ],
                                'cc'  => 2,
                                'cwc' => 2,
                            ],
                        'li' => [
                                'c' => [
                                        'iq' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'ib' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'lo' => [
                                'c' => [
                                        'ov' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'lt' => [
                                'lc' => [
                                        'tz' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'ly' => [
                            ],
                        'mp' => [
                                'lc' => [
                                        'ph' => 2,
                                        'ps' => 1,
                                    ],
                                'lcc'  => 2,
                                'lcwc' => 3,
                            ],
                        'my' => [
                            ],
                        'ng' => [
                                'c' => [
                                        'gl' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'nx' => [
                            ],
                        'ny' => [
                                'c' => [
                                        'ym' => 2,
                                    ],
                                'cc'  => 1,
                                'cwc' => 2,
                            ],
                        'oc' => [
                                'c' => [
                                        'ck' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'of' => [
                            ],
                        'og' => [
                            ],
                        'or' => [
                            ],
                        'ov' => [
                                'c' => [
                                        've' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        've' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'ow' => [
                                'lc' => [
                                        'wn' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'ox' => [
                                'c' => [
                                        'xi' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'oz' => [
                                'c' => [
                                        'ze' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'pa' => [
                                'c' => [
                                        'ac' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'ph' => [
                                'c' => [
                                        'hi' => 2,
                                    ],
                                'cc'  => 1,
                                'cwc' => 2,
                            ],
                        'ps' => [
                            ],
                        'qu' => [
                                'c' => [
                                        'ui' => 5,
                                        'ua' => 2,
                                        'uo' => 1,
                                    ],
                                'cc'  => 3,
                                'cwc' => 8,
                            ],
                        'ra' => [
                                'c' => [
                                        'ab' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'as' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'rd' => [
                                'lc' => [
                                        'ds' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'rf' => [
                            ],
                        'ro' => [
                                'c' => [
                                        'ow' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'rt' => [
                                'lc' => [
                                        'tz' => 2,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 2,
                            ],
                        'sp' => [
                                'c' => [
                                        'ph' => 2,
                                    ],
                                'cc'  => 1,
                                'cwc' => 2,
                            ],
                        'th' => [
                                'lc' => [
                                        'he' => 3,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 3,
                            ],
                        'to' => [
                            ],
                        'tz' => [
                            ],
                        'ua' => [
                                'c' => [
                                        'ar' => 2,
                                    ],
                                'cc'  => 1,
                                'cwc' => 2,
                            ],
                        'ud' => [
                                'c' => [
                                        'dg' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'ug' => [
                                'lc' => [
                                        'gs' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'ui' => [
                                'c' => [
                                        'ic' => 4,
                                    ],
                                'cc'  => 1,
                                'cwc' => 4,
                                'lc'  => [
                                        'iz' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'um' => [
                                'c' => [
                                        'mp' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'mp' => 2,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 2,
                            ],
                        'uo' => [
                                'lc' => [
                                        'or' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        've' => [
                                'c' => [
                                        'ex' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'er' => 1,
                                        'ed' => 1,
                                        'ex' => 1,
                                    ],
                                'lcc'  => 3,
                                'lcwc' => 3,
                            ],
                        'vo' => [
                                'lc' => [
                                        'ow' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'wa' => [
                                'c' => [
                                        'al' => 1,
                                        'ar' => 1,
                                    ],
                                'cc'  => 2,
                                'cwc' => 2,
                            ],
                        'wi' => [
                                'c' => [
                                        'iz' => 1,
                                        'it' => 1,
                                    ],
                                'cc'  => 2,
                                'cwc' => 2,
                            ],
                        'wn' => [
                            ],
                        'ws' => [
                            ],
                        'xi' => [
                                'c' => [
                                        'in' => 2,
                                    ],
                                'cc'  => 1,
                                'cwc' => 2,
                            ],
                        'ym' => [
                                'c' => [
                                        'mp' => 2,
                                    ],
                                'cc'  => 1,
                                'cwc' => 2,
                            ],
                        'za' => [
                                'c' => [
                                        'ar' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                            ],
                        'ze' => [
                                'c' => [
                                        'eb' => 1,
                                    ],
                                'cc'  => 1,
                                'cwc' => 1,
                                'lc'  => [
                                        'en' => 1,
                                    ],
                                'lcc'  => 1,
                                'lcwc' => 1,
                            ],
                        'zy' => [
                            ],
                    ],
                'elements_count' => 97,
                'first_elements' => [
                        'qu' => 7,
                        'ju' => 5,
                        'th' => 3,
                        'my' => 3,
                        'fo' => 2,
                        'do' => 2,
                        'ny' => 2,
                        've' => 2,
                        'sp' => 2,
                        'of' => 2,
                        'fi' => 2,
                        'bo' => 2,
                        'wi' => 2,
                        'br' => 1,
                        'ov' => 1,
                        'la' => 1,
                        'ji' => 1,
                        'gr' => 1,
                        'wa' => 1,
                        'gl' => 1,
                        'jo' => 1,
                        'to' => 1,
                        'dw' => 1,
                        'bl' => 1,
                        'vo' => 1,
                        'ho' => 1,
                        'da' => 1,
                        'ze' => 1,
                        'ja' => 1,
                        'lo' => 1,
                        'bi' => 1,
                        'pa' => 1,
                        'li' => 1,
                    ],
                'first_elements_count'        => 33,
                'first_elements_weight_count' => 56,
                'sentence_elements'           => [
                        3 => [
                                'qu' => 2,
                                'bo' => 2,
                                'br' => 1,
                                'ny' => 1,
                                'bl' => 1,
                                'my' => 1,
                            ],
                        2 => [
                                'qu' => 1,
                                'fo' => 1,
                                'jo' => 1,
                                'of' => 1,
                                've' => 1,
                                'fi' => 1,
                                'lo' => 1,
                                'my' => 1,
                            ],
                        1 => [
                                'th' => 2,
                                'ji' => 1,
                                'gl' => 1,
                                'sp' => 1,
                                'ho' => 1,
                                'ja' => 1,
                                'pa' => 1,
                            ],
                        -1 => [
                                'ju' => 2,
                                'qu' => 2,
                                'do' => 1,
                                'wa' => 1,
                                'dw' => 1,
                                'vo' => 1,
                            ],
                        -2 => [
                                'la' => 1,
                                'qu' => 1,
                                've' => 1,
                                'my' => 1,
                                'ze' => 1,
                                'ju' => 1,
                                'of' => 1,
                                'li' => 1,
                            ],
                        -3 => [
                                'th' => 1,
                                'gr' => 1,
                                'to' => 1,
                                'ju' => 1,
                                'da' => 1,
                                'wi' => 1,
                                'sp' => 1,
                                'do' => 1,
                            ],
                    ],
                'sentence_elements_count' => [
                        1  => 7,
                        2  => 8,
                        3  => 6,
                        -3 => 8,
                        -2 => 8,
                        -1 => 6,
                    ],
                'sentence_elements_weight_count' => [
                        1  => 8,
                        2  => 8,
                        3  => 8,
                        -3 => 8,
                        -2 => 8,
                        -1 => 8,
                    ],
                'word_lengths' => [
                        5 => 15,
                        4 => 13,
                        3 => 11,
                        6 => 7,
                        2 => 6,
                        8 => 2,
                        7 => 2,
                    ],
                'word_lenghts_count'        => 7,
                'word_lenghts_weight_count' => 56,
                'sentence_lengths'          => [
                        6 => 3,
                        7 => 3,
                        9 => 1,
                        8 => 1,
                    ],
                'sentence_lenghts_count'        => 4,
                'sentence_lenghts_weight_count' => 8,
                'excluded_words'                => [
                        0  => 'big',
                        1  => 'black',
                        2  => 'box',
                        3  => 'boxing',
                        4  => 'brown',
                        5  => 'daft',
                        6  => 'dog',
                        7  => 'dozen',
                        8  => 'dwarf',
                        9  => 'five',
                        10 => 'five',
                        11 => 'fox',
                        12 => 'fox',
                        13 => 'glib',
                        14 => 'grabs',
                        15 => 'how',
                        16 => 'jackdaws',
                        17 => 'jived',
                        18 => 'jocks',
                        19 => 'judge',
                        20 => 'jugs',
                        21 => 'jump',
                        22 => 'jump',
                        23 => 'jumps',
                        24 => 'lazy',
                        25 => 'liquor',
                        26 => 'love',
                        27 => 'my',
                        28 => 'my',
                        29 => 'my',
                        30 => 'nymph',
                        31 => 'nymph',
                        32 => 'of',
                        33 => 'of',
                        34 => 'over',
                        35 => 'pack',
                        36 => 'quartz',
                        37 => 'quartz',
                        38 => 'quick',
                        39 => 'quick',
                        40 => 'quick',
                        41 => 'quickly',
                        42 => 'quiz',
                        43 => 'sphinx',
                        44 => 'sphinx',
                        45 => 'the',
                        46 => 'the',
                        47 => 'the',
                        48 => 'to',
                        49 => 'vex',
                        50 => 'vexingly',
                        51 => 'vow',
                        52 => 'waltz',
                        53 => 'with',
                        54 => 'wizards',
                        55 => 'zebras',
                    ],
                'excluded_words_count' => 56,
            ],
    ];

    expect($modelData)->toBe($expected);
});
