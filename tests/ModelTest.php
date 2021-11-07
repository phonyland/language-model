<?php

declare(strict_types=1);

use Phonyland\LanguageModel\Model;
use Phonyland\NGram\Tokenizer;
use Phonyland\NGram\TokenizerFilter;

test('Model can be build with count', function (): void {
    $model = new Model('Test Model');
    $model->config
        ->n(2)
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
                        'th' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'he' => 3,
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
                                        'ui' => 5,
                                        'ua' => 2,
                                        'uo' => 1,
                                    ],
                                1 => 0,
                            ],
                        'ui' =>
                            [
                                0 =>
                                    [
                                        'ic' => 4,
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
                                        'ck' => 3,
                                    ],
                            ],
                        'ck' =>
                            [
                                0 =>
                                    [
                                        'kl' => 1,
                                        'kd' => 1,
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
                                        'ro' => 1,
                                        'ra' => 1,
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
                                        'ox' => 2,
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
                                        'um' => 3,
                                        'ud' => 1,
                                        'ug' => 1,
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
                                        'mp' => 2,
                                    ],
                            ],
                        'mp' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'ph' => 2,
                                        'ps' => 1,
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
                                        'er' => 1,
                                        'ed' => 1,
                                        'ex' => 1,
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
                                        'az' => 1,
                                        'ac' => 1,
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
                                        've' => 2,
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
                                        'ym' => 2,
                                    ],
                                1 => 0,
                            ],
                        'ym' =>
                            [
                                0 =>
                                    [
                                        'mp' => 2,
                                    ],
                                1 => 0,
                            ],
                        'ph' =>
                            [
                                0 =>
                                    [
                                        'hi' => 2,
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
                                        'al' => 1,
                                        'ar' => 1,
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
                                        'rt' => 2,
                                        'rd' => 1,
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
                                        'ph' => 2,
                                    ],
                                1 => 0,
                            ],
                        'hi' =>
                            [
                                0 =>
                                    [
                                        'in' => 2,
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
                                        'nx' => 2,
                                        'ng' => 1,
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
                                        'ck' => 2,
                                    ],
                            ],
                        'ua' =>
                            [
                                0 =>
                                    [
                                        'ar' => 2,
                                    ],
                                1 => 0,
                            ],
                        'rt' =>
                            [
                                0 => 0,
                                1 =>
                                    [
                                        'tz' => 2,
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
                                        'in' => 2,
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
                                        'af' => 1,
                                        'aw' => 1,
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
                                        'iv' => 2,
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
                                        'iz' => 1,
                                        'it' => 1,
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
                'sentence_elements' =>
                    [
                        1 =>
                            [
                                'th' => 2,
                                'ji' => 1,
                                'gl' => 1,
                                'sp' => 1,
                                'ho' => 1,
                                'ja' => 1,
                                'pa' => 1,
                            ],
                        2 =>
                            [
                                'qu' => 1,
                                'fo' => 1,
                                'jo' => 1,
                                'of' => 1,
                                've' => 1,
                                'fi' => 1,
                                'lo' => 1,
                                'my' => 1,
                            ],
                        3 =>
                            [
                                'qu' => 2,
                                'bo' => 2,
                                'br' => 1,
                                'ny' => 1,
                                'bl' => 1,
                                'my' => 1,
                            ],
                        -3 =>
                            [
                                'th' => 1,
                                'gr' => 1,
                                'to' => 1,
                                'ju' => 1,
                                'da' => 1,
                                'wi' => 1,
                                'sp' => 1,
                                'do' => 1,
                            ],
                        -2 =>
                            [
                                'la' => 1,
                                'qu' => 1,
                                've' => 1,
                                'my' => 1,
                                'ze' => 1,
                                'ju' => 1,
                                'of' => 1,
                                'li' => 1,
                            ],
                        -1 =>
                            [
                                'ju' => 2,
                                'qu' => 2,
                                'do' => 1,
                                'wa' => 1,
                                'dw' => 1,
                                'vo' => 1,
                            ],
                    ],
            ],
        'statistics' =>
            [
                'word_lengths' =>
                    [
                        5 => 15,
                        4 => 13,
                        3 => 11,
                        6 => 7,
                        2 => 6,
                        8 => 2,
                        7 => 2,
                    ],
                'sentence_lengths' =>
                    [
                        6 => 3,
                        7 => 3,
                        9 => 1,
                        8 => 1,
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
