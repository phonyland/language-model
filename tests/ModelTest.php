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
                  ->sentenceElements(3)
        ->tokenizer->addWordSeparatorPattern(TokenizerFilter::WHITESPACE_SEPARATOR)
                   ->addWordFilterRule(TokenizerFilter::LATIN_EXTENDED_ALPHABETICAL)
                   ->addSentenceSeparatorPattern(['.', '?', '!', ':', ';', '\n'])
                   ->toLowercase();

    $model->feed('The quick brown fox jumps over the lazy dog.');
    $model->feed('Jived fox nymph grabs quick waltz.');
    $model->feed('Glib jocks quiz nymph to vex dwarf.');
    $model->feed('Sphinx of black quartz, judge my vow.');
    $model->feed('How vexingly quick daft zebras jump!');
    $model->feed('The five boxing wizards jump quickly.');
    $model->feed('Jackdaws love my big sphinx of quartz.');
    $model->feed('Pack my box with five dozen liquor jugs.');

    $model->calculate();

    $model = $model->toArray();
    $expected = [
        'config' =>
            [
                'name' => 'Test Model',
                'n' => 2,
                'min_lenght' => 2,
                'unique' => false,
                'exclude_originals' => true,
                'frequency_precision' => 7,
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
                        'th' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'he' => 1,
                                    ],
                            ],
                        'he' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'qu' =>
                            [
                                0 =>
                                    [
                                        'ui' => 0.625,
                                        'ua' => 0.25,
                                        'uo' => 0.125,
                                    ],
                                1 => 0,
                            ],
                        'ui' =>
                            [
                                0 =>
                                    [
                                        'ic' => 1,
                                    ],
                                1 =>
                                    [
                                        'iz' => 1,
                                    ],
                            ],
                        'ic' =>
                            [
                                0 =>
                                    [
                                        'ck' => 1,
                                    ],
                                1 =>
                                    [
                                        'ck' => 1,
                                    ],
                            ],
                        'ck' =>
                            [
                                0 =>
                                    [
                                        'kl' => 0.5,
                                        'kd' => 0.5,
                                    ],
                                1 =>
                                    [
                                        'ks' => 1,
                                    ],
                            ],
                        'br' =>
                            [
                                0 =>
                                    [
                                        'ro' => 0.5,
                                        'ra' => 0.5,
                                    ],
                                1 => 0,
                            ],
                        'ro' =>
                            [
                                0 =>
                                    [
                                        'ow' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ow' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'wn' => 1,
                                    ],
                            ],
                        'wn' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'fo' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ox' => 1,
                                    ],
                            ],
                        'ox' =>
                            [
                                0 =>
                                    [
                                        'xi' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ju' =>
                            [
                                0 =>
                                    [
                                        'um' => 0.6,
                                        'ud' => 0.2,
                                        'ug' => 0.2,
                                    ],
                                1 => 0,
                            ],
                        'um' =>
                            [
                                0 =>
                                    [
                                        'mp' => 1,
                                    ],
                                1 =>
                                    [
                                        'mp' => 1,
                                    ],
                            ],
                        'mp' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ps' => 0.3333333333333333,
                                        'ph' => 0.6666666666666666,
                                    ],
                            ],
                        'ps' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'ov' =>
                            [
                                0 =>
                                    [
                                        've' => 1,
                                    ],
                                1 =>
                                    [
                                        've' => 1,
                                    ],
                            ],
                        've' =>
                            [
                                0 =>
                                    [
                                        'ex' => 1,
                                    ],
                                1 =>
                                    [
                                        'er' => 0.3333333333333333,
                                        'ed' => 0.3333333333333333,
                                        'ex' => 0.3333333333333333,
                                    ],
                            ],
                        'er' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'la' =>
                            [
                                0 =>
                                    [
                                        'az' => 0.5,
                                        'ac' => 0.5,
                                    ],
                                1 => 0,
                            ],
                        'az' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'zy' => 1,
                                    ],
                            ],
                        'zy' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'do' =>
                            [
                                0 =>
                                    [
                                        'oz' => 1,
                                    ],
                                1 =>
                                    [
                                        'og' => 1,
                                    ],
                            ],
                        'og' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'ji' =>
                            [
                                0 =>
                                    [
                                        'iv' => 1,
                                    ],
                                1 => 0,
                            ],
                        'iv' =>
                            [
                                0 =>
                                    [
                                        've' => 1,
                                    ],
                                1 =>
                                    [
                                        've' => 1,
                                    ],
                            ],
                        'ed' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'ny' =>
                            [
                                0 =>
                                    [
                                        'ym' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ym' =>
                            [
                                0 =>
                                    [
                                        'mp' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ph' =>
                            [
                                0 =>
                                    [
                                        'hi' => 1,
                                    ],
                                1 => 0,
                            ],
                        'gr' =>
                            [
                                0 =>
                                    [
                                        'ra' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ra' =>
                            [
                                0 =>
                                    [
                                        'ab' => 1,
                                    ],
                                1 =>
                                    [
                                        'as' => 1,
                                    ],
                            ],
                        'ab' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'bs' => 1,
                                    ],
                            ],
                        'bs' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'wa' =>
                            [
                                0 =>
                                    [
                                        'al' => 0.5,
                                        'ar' => 0.5,
                                    ],
                                1 => 0,
                            ],
                        'al' =>
                            [
                                0 =>
                                    [
                                        'lt' => 1,
                                    ],
                                1 => 0,
                            ],
                        'lt' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'tz' => 1,
                                    ],
                            ],
                        'tz' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'gl' =>
                            [
                                0 =>
                                    [
                                        'li' => 1,
                                    ],
                                1 =>
                                    [
                                        'ly' => 1,
                                    ],
                            ],
                        'li' =>
                            [
                                0 =>
                                    [
                                        'iq' => 1,
                                    ],
                                1 =>
                                    [
                                        'ib' => 1,
                                    ],
                            ],
                        'ib' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'jo' =>
                            [
                                0 =>
                                    [
                                        'oc' => 1,
                                    ],
                                1 => 0,
                            ],
                        'oc' =>
                            [
                                0 =>
                                    [
                                        'ck' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ks' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'iz' =>
                            [
                                0 =>
                                    [
                                        'za' => 1,
                                    ],
                                1 => 0,
                            ],
                        'to' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'ex' =>
                            [
                                0 =>
                                    [
                                        'xi' => 1,
                                    ],
                                1 => 0,
                            ],
                        'dw' =>
                            [
                                0 =>
                                    [
                                        'wa' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ar' =>
                            [
                                0 =>
                                    [
                                        'rt' => 0.6666666666666666,
                                        'rd' => 0.3333333333333333,
                                    ],
                                1 =>
                                    [
                                        'rf' => 1,
                                    ],
                            ],
                        'rf' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'sp' =>
                            [
                                0 =>
                                    [
                                        'ph' => 1,
                                    ],
                                1 => 0,
                            ],
                        'hi' =>
                            [
                                0 =>
                                    [
                                        'in' => 1,
                                    ],
                                1 => 0,
                            ],
                        'in' =>
                            [
                                0 =>
                                    [
                                        'ng' => 1,
                                    ],
                                1 =>
                                    [
                                        'nx' => 0.6666666666666666,
                                        'ng' => 0.3333333333333333,
                                    ],
                            ],
                        'nx' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'of' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'bl' =>
                            [
                                0 =>
                                    [
                                        'la' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ac' =>
                            [
                                0 =>
                                    [
                                        'ck' => 1,
                                    ],
                                1 =>
                                    [
                                        'ck' => 1,
                                    ],
                            ],
                        'ua' =>
                            [
                                0 =>
                                    [
                                        'ar' => 1,
                                    ],
                                1 => 0,
                            ],
                        'rt' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'tz' => 1,
                                    ],
                            ],
                        'ud' =>
                            [
                                0 =>
                                    [
                                        'dg' => 1,
                                    ],
                                1 => 0,
                            ],
                        'dg' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ge' => 1,
                                    ],
                            ],
                        'ge' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'my' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'vo' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ow' => 1,
                                    ],
                            ],
                        'ho' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ow' => 1,
                                    ],
                            ],
                        'xi' =>
                            [
                                0 =>
                                    [
                                        'in' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ng' =>
                            [
                                0 =>
                                    [
                                        'gl' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ly' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'da' =>
                            [
                                0 =>
                                    [
                                        'af' => 0.5,
                                        'aw' => 0.5,
                                    ],
                                1 => 0,
                            ],
                        'af' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ft' => 1,
                                    ],
                            ],
                        'ft' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'ze' =>
                            [
                                0 =>
                                    [
                                        'eb' => 1,
                                    ],
                                1 =>
                                    [
                                        'en' => 1,
                                    ],
                            ],
                        'eb' =>
                            [
                                0 =>
                                    [
                                        'br' => 1,
                                    ],
                                1 => 0,
                            ],
                        'as' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'fi' =>
                            [
                                0 =>
                                    [
                                        'iv' => 1,
                                    ],
                                1 => 0,
                            ],
                        'bo' =>
                            [
                                0 =>
                                    [
                                        'ox' => 1,
                                    ],
                                1 =>
                                    [
                                        'ox' => 1,
                                    ],
                            ],
                        'wi' =>
                            [
                                0 =>
                                    [
                                        'iz' => 0.5,
                                        'it' => 0.5,
                                    ],
                                1 => 0,
                            ],
                        'za' =>
                            [
                                0 =>
                                    [
                                        'ar' => 1,
                                    ],
                                1 => 0,
                            ],
                        'rd' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ds' => 1,
                                    ],
                            ],
                        'ds' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'kl' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ly' => 1,
                                    ],
                            ],
                        'ja' =>
                            [
                                0 =>
                                    [
                                        'ac' => 1,
                                    ],
                                1 => 0,
                            ],
                        'kd' =>
                            [
                                0 =>
                                    [
                                        'da' => 1,
                                    ],
                                1 => 0,
                            ],
                        'aw' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ws' => 1,
                                    ],
                            ],
                        'ws' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'lo' =>
                            [
                                0 =>
                                    [
                                        'ov' => 1,
                                    ],
                                1 => 0,
                            ],
                        'bi' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ig' => 1,
                                    ],
                            ],
                        'ig' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'pa' =>
                            [
                                0 =>
                                    [
                                        'ac' => 1,
                                    ],
                                1 => 0,
                            ],
                        'it' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'th' => 1,
                                    ],
                            ],
                        'oz' =>
                            [
                                0 =>
                                    [
                                        'ze' => 1,
                                    ],
                                1 => 0,
                            ],
                        'en' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'iq' =>
                            [
                                0 =>
                                    [
                                        'qu' => 1,
                                    ],
                                1 => 0,
                            ],
                        'uo' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'or' => 1,
                                    ],
                            ],
                        'or' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                        'ug' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'gs' => 1,
                                    ],
                            ],
                        'gs' =>
                            [
                                0 => 0,
                                1 => 0,
                            ],
                    ],
                'first_elements' =>
                    [
                        'th' => 0.05357142857142857,
                        'qu' => 0.125,
                        'br' => 0.017857142857142856,
                        'fo' => 0.03571428571428571,
                        'ju' => 0.08928571428571429,
                        'ov' => 0.017857142857142856,
                        'la' => 0.017857142857142856,
                        'do' => 0.03571428571428571,
                        'ji' => 0.017857142857142856,
                        'ny' => 0.03571428571428571,
                        'gr' => 0.017857142857142856,
                        'wa' => 0.017857142857142856,
                        'gl' => 0.017857142857142856,
                        'jo' => 0.017857142857142856,
                        'to' => 0.017857142857142856,
                        've' => 0.03571428571428571,
                        'dw' => 0.017857142857142856,
                        'sp' => 0.03571428571428571,
                        'of' => 0.03571428571428571,
                        'bl' => 0.017857142857142856,
                        'my' => 0.05357142857142857,
                        'vo' => 0.017857142857142856,
                        'ho' => 0.017857142857142856,
                        'da' => 0.017857142857142856,
                        'ze' => 0.017857142857142856,
                        'fi' => 0.03571428571428571,
                        'bo' => 0.03571428571428571,
                        'wi' => 0.03571428571428571,
                        'ja' => 0.017857142857142856,
                        'lo' => 0.017857142857142856,
                        'bi' => 0.017857142857142856,
                        'pa' => 0.017857142857142856,
                        'li' => 0.017857142857142856,
                    ],
                'sentence_elements' =>
                    [
                        1 =>
                            [
                                'th' => 0.25,
                                'ji' => 0.125,
                                'gl' => 0.125,
                                'sp' => 0.125,
                                'ho' => 0.125,
                                'ja' => 0.125,
                                'pa' => 0.125,
                            ],
                        2 =>
                            [
                                'qu' => 0.125,
                                'fo' => 0.125,
                                'jo' => 0.125,
                                'of' => 0.125,
                                've' => 0.125,
                                'fi' => 0.125,
                                'lo' => 0.125,
                                'my' => 0.125,
                            ],
                        3 =>
                            [
                                'br' => 0.125,
                                'ny' => 0.125,
                                'qu' => 0.25,
                                'bl' => 0.125,
                                'bo' => 0.25,
                                'my' => 0.125,
                            ],
                        -3 =>
                            [
                                'th' => 0.125,
                                'gr' => 0.125,
                                'to' => 0.125,
                                'ju' => 0.125,
                                'da' => 0.125,
                                'wi' => 0.125,
                                'sp' => 0.125,
                                'do' => 0.125,
                            ],
                        -2 =>
                            [
                                'la' => 0.125,
                                'qu' => 0.125,
                                've' => 0.125,
                                'my' => 0.125,
                                'ze' => 0.125,
                                'ju' => 0.125,
                                'of' => 0.125,
                                'li' => 0.125,
                            ],
                        -1 =>
                            [
                                'do' => 0.125,
                                'wa' => 0.125,
                                'dw' => 0.125,
                                'vo' => 0.125,
                                'ju' => 0.25,
                                'qu' => 0.25,
                            ],
                    ],
            ],
        'statistics' =>
            [
                'word_lengths' =>
                    [
                        5 => 0.26785714285714285,
                        4 => 0.23214285714285715,
                        3 => 0.19642857142857142,
                        6 => 0.125,
                        2 => 0.10714285714285714,
                        8 => 0.03571428571428571,
                        7 => 0.03571428571428571,
                    ],
                'sentence_lengths' =>
                    [
                        6 => 0.375,
                        7 => 0.375,
                        9 => 0.125,
                        8 => 0.125,
                    ],
            ],
        'excluded' =>
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
    ];

    expect($model)->toBe($expected);
});
