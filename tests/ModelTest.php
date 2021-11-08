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
                                'lc' =>
                                    [
                                        'bs' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'ac' =>
                            [
                                'c' =>
                                    [
                                        'ck' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'ck' => 4,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 4,
                            ],
                        'af' =>
                            [
                                'lc' =>
                                    [
                                        'ft' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'al' =>
                            [
                                'c' =>
                                    [
                                        'lt' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                            ],
                        'ar' =>
                            [
                                'c' =>
                                    [
                                        'rt' => 4,
                                        'rd' => 2,
                                    ],
                                'cc' => 2,
                                'cwc' => 6,
                                'lc' =>
                                    [
                                        'rf' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'as' =>
                            [
                            ],
                        'aw' =>
                            [
                                'lc' =>
                                    [
                                        'ws' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'az' =>
                            [
                                'lc' =>
                                    [
                                        'zy' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'bi' =>
                            [
                                'lc' =>
                                    [
                                        'ig' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'bl' =>
                            [
                                'c' =>
                                    [
                                        'la' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'bo' =>
                            [
                                'c' =>
                                    [
                                        'ox' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'ox' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'br' =>
                            [
                                'c' =>
                                    [
                                        'ra' => 2,
                                        'ro' => 1,
                                    ],
                                'cc' => 2,
                                'cwc' => 3,
                            ],
                        'bs' =>
                            [
                            ],
                        'ck' =>
                            [
                                'c' =>
                                    [
                                        'kl' => 2,
                                        'kd' => 2,
                                    ],
                                'cc' => 2,
                                'cwc' => 4,
                                'lc' =>
                                    [
                                        'ks' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'da' =>
                            [
                                'c' =>
                                    [
                                        'af' => 2,
                                        'aw' => 2,
                                    ],
                                'cc' => 2,
                                'cwc' => 4,
                            ],
                        'dg' =>
                            [
                                'lc' =>
                                    [
                                        'ge' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'do' =>
                            [
                                'c' =>
                                    [
                                        'oz' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'og' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'ds' =>
                            [
                            ],
                        'dw' =>
                            [
                                'c' =>
                                    [
                                        'wa' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                            ],
                        'eb' =>
                            [
                                'c' =>
                                    [
                                        'br' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'ed' =>
                            [
                            ],
                        'en' =>
                            [
                            ],
                        'er' =>
                            [
                            ],
                        'ex' =>
                            [
                                'c' =>
                                    [
                                        'xi' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'fi' =>
                            [
                                'c' =>
                                    [
                                        'iv' => 4,
                                    ],
                                'cc' => 1,
                                'cwc' => 4,
                            ],
                        'fo' =>
                            [
                                'lc' =>
                                    [
                                        'ox' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'ft' =>
                            [
                            ],
                        'ge' =>
                            [
                            ],
                        'gl' =>
                            [
                                'c' =>
                                    [
                                        'li' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        'ly' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'gr' =>
                            [
                                'c' =>
                                    [
                                        'ra' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                            ],
                        'gs' =>
                            [
                            ],
                        'he' =>
                            [
                            ],
                        'hi' =>
                            [
                                'c' =>
                                    [
                                        'in' => 4,
                                    ],
                                'cc' => 1,
                                'cwc' => 4,
                            ],
                        'ho' =>
                            [
                                'lc' =>
                                    [
                                        'ow' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'ib' =>
                            [
                            ],
                        'ic' =>
                            [
                                'c' =>
                                    [
                                        'ck' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'ck' => 4,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 4,
                            ],
                        'ig' =>
                            [
                            ],
                        'in' =>
                            [
                                'c' =>
                                    [
                                        'ng' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'nx' => 4,
                                        'ng' => 2,
                                    ],
                                'lcc' => 2,
                                'lcwc' => 6,
                            ],
                        'iq' =>
                            [
                                'c' =>
                                    [
                                        'qu' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'it' =>
                            [
                                'lc' =>
                                    [
                                        'th' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'iv' =>
                            [
                                'c' =>
                                    [
                                        've' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        've' => 4,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 4,
                            ],
                        'iz' =>
                            [
                                'c' =>
                                    [
                                        'za' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'ja' =>
                            [
                                'c' =>
                                    [
                                        'ac' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'ji' =>
                            [
                                'c' =>
                                    [
                                        'iv' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                            ],
                        'jo' =>
                            [
                                'c' =>
                                    [
                                        'oc' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                            ],
                        'ju' =>
                            [
                                'c' =>
                                    [
                                        'um' => 5,
                                        'ud' => 2,
                                        'ug' => 2,
                                    ],
                                'cc' => 3,
                                'cwc' => 9,
                            ],
                        'kd' =>
                            [
                                'c' =>
                                    [
                                        'da' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'kl' =>
                            [
                                'lc' =>
                                    [
                                        'ly' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'ks' =>
                            [
                            ],
                        'la' =>
                            [
                                'c' =>
                                    [
                                        'ac' => 2,
                                        'az' => 1,
                                    ],
                                'cc' => 2,
                                'cwc' => 3,
                            ],
                        'li' =>
                            [
                                'c' =>
                                    [
                                        'iq' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'ib' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'lo' =>
                            [
                                'c' =>
                                    [
                                        'ov' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'lt' =>
                            [
                                'lc' =>
                                    [
                                        'tz' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'ly' =>
                            [
                            ],
                        'mp' =>
                            [
                                'lc' =>
                                    [
                                        'ph' => 2,
                                        'ps' => 1,
                                    ],
                                'lcc' => 2,
                                'lcwc' => 3,
                            ],
                        'my' =>
                            [
                            ],
                        'ng' =>
                            [
                                'c' =>
                                    [
                                        'gl' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'nx' =>
                            [
                            ],
                        'ny' =>
                            [
                                'c' =>
                                    [
                                        'ym' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'oc' =>
                            [
                                'c' =>
                                    [
                                        'ck' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                            ],
                        'of' =>
                            [
                            ],
                        'og' =>
                            [
                            ],
                        'or' =>
                            [
                            ],
                        'ov' =>
                            [
                                'c' =>
                                    [
                                        've' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        've' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'ow' =>
                            [
                                'lc' =>
                                    [
                                        'wn' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'ox' =>
                            [
                                'c' =>
                                    [
                                        'xi' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'oz' =>
                            [
                                'c' =>
                                    [
                                        'ze' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'pa' =>
                            [
                                'c' =>
                                    [
                                        'ac' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'ph' =>
                            [
                                'c' =>
                                    [
                                        'hi' => 4,
                                    ],
                                'cc' => 1,
                                'cwc' => 4,
                            ],
                        'ps' =>
                            [
                            ],
                        'qu' =>
                            [
                                'c' =>
                                    [
                                        'ui' => 7,
                                        'ua' => 4,
                                        'uo' => 2,
                                    ],
                                'cc' => 3,
                                'cwc' => 13,
                            ],
                        'ra' =>
                            [
                                'c' =>
                                    [
                                        'ab' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        'as' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'rd' =>
                            [
                                'lc' =>
                                    [
                                        'ds' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'rf' =>
                            [
                            ],
                        'ro' =>
                            [
                                'c' =>
                                    [
                                        'ow' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                            ],
                        'rt' =>
                            [
                                'lc' =>
                                    [
                                        'tz' => 4,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 4,
                            ],
                        'sp' =>
                            [
                                'c' =>
                                    [
                                        'ph' => 4,
                                    ],
                                'cc' => 1,
                                'cwc' => 4,
                            ],
                        'th' =>
                            [
                                'lc' =>
                                    [
                                        'he' => 4,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 4,
                            ],
                        'to' =>
                            [
                            ],
                        'tz' =>
                            [
                            ],
                        'ua' =>
                            [
                                'c' =>
                                    [
                                        'ar' => 4,
                                    ],
                                'cc' => 1,
                                'cwc' => 4,
                            ],
                        'ud' =>
                            [
                                'c' =>
                                    [
                                        'dg' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'ug' =>
                            [
                                'lc' =>
                                    [
                                        'gs' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'ui' =>
                            [
                                'c' =>
                                    [
                                        'ic' => 6,
                                    ],
                                'cc' => 1,
                                'cwc' => 6,
                                'lc' =>
                                    [
                                        'iz' => 1,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 1,
                            ],
                        'um' =>
                            [
                                'c' =>
                                    [
                                        'mp' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        'mp' => 4,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 4,
                            ],
                        'uo' =>
                            [
                                'lc' =>
                                    [
                                        'or' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        've' =>
                            [
                                'c' =>
                                    [
                                        'ex' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'er' => 1,
                                        'ed' => 1,
                                        'ex' => 1,
                                    ],
                                'lcc' => 3,
                                'lcwc' => 3,
                            ],
                        'vo' =>
                            [
                                'lc' =>
                                    [
                                        'ow' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'wa' =>
                            [
                                'c' =>
                                    [
                                        'al' => 1,
                                        'ar' => 1,
                                    ],
                                'cc' => 2,
                                'cwc' => 2,
                            ],
                        'wi' =>
                            [
                                'c' =>
                                    [
                                        'iz' => 2,
                                        'it' => 2,
                                    ],
                                'cc' => 2,
                                'cwc' => 4,
                            ],
                        'wn' =>
                            [
                            ],
                        'ws' =>
                            [
                            ],
                        'xi' =>
                            [
                                'c' =>
                                    [
                                        'in' => 4,
                                    ],
                                'cc' => 1,
                                'cwc' => 4,
                            ],
                        'ym' =>
                            [
                                'c' =>
                                    [
                                        'mp' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'za' =>
                            [
                                'c' =>
                                    [
                                        'ar' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                            ],
                        'ze' =>
                            [
                                'c' =>
                                    [
                                        'eb' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'en' => 2,
                                    ],
                                'lcc' => 1,
                                'lcwc' => 2,
                            ],
                        'zy' =>
                            [
                            ],
                    ],
                'elements_count' => 97,
                'first_elements' =>
                    [
                        'qu' => 11,
                        'ju' => 9,
                        'my' => 6,
                        'th' => 4,
                        'sp' => 4,
                        'of' => 4,
                        'fi' => 4,
                        'bo' => 4,
                        'wi' => 4,
                        'do' => 3,
                        've' => 3,
                        'fo' => 2,
                        'ny' => 2,
                        'bl' => 2,
                        'vo' => 2,
                        'ho' => 2,
                        'da' => 2,
                        'ze' => 2,
                        'ja' => 2,
                        'lo' => 2,
                        'bi' => 2,
                        'pa' => 2,
                        'li' => 2,
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
                    ],
                'first_elements_count' => 33,
                'first_elements_weight_count' => 90,
                'sentence_elements' =>
                    [
                        3 =>
                            [
                                'bo' => 4,
                                'qu' => 3,
                                'bl' => 2,
                                'my' => 2,
                                'br' => 1,
                                'ny' => 1,
                            ],
                        2 =>
                            [
                                'of' => 2,
                                've' => 2,
                                'fi' => 2,
                                'lo' => 2,
                                'my' => 2,
                                'qu' => 1,
                                'fo' => 1,
                                'jo' => 1,
                            ],
                        1 =>
                            [
                                'th' => 3,
                                'sp' => 2,
                                'ho' => 2,
                                'ja' => 2,
                                'pa' => 2,
                                'ji' => 1,
                                'gl' => 1,
                            ],
                        -1 =>
                            [
                                'ju' => 4,
                                'qu' => 4,
                                'vo' => 2,
                                'do' => 1,
                                'wa' => 1,
                                'dw' => 1,
                            ],
                        -2 =>
                            [
                                'my' => 2,
                                'ze' => 2,
                                'ju' => 2,
                                'of' => 2,
                                'li' => 2,
                                'la' => 1,
                                'qu' => 1,
                                've' => 1,
                            ],
                        -3 =>
                            [
                                'ju' => 2,
                                'da' => 2,
                                'wi' => 2,
                                'sp' => 2,
                                'do' => 2,
                                'th' => 1,
                                'gr' => 1,
                                'to' => 1,
                            ],
                    ],
                'sentence_elements_count' =>
                    [
                        1 => 7,
                        2 => 8,
                        3 => 6,
                        -3 => 8,
                        -2 => 8,
                        -1 => 6,
                    ],
                'sentence_elements_weight_count' =>
                    [
                        1 => 13,
                        2 => 13,
                        3 => 13,
                        -3 => 13,
                        -2 => 13,
                        -1 => 13,
                    ],
                'word_lengths' =>
                    [
                        4 => 22,
                        5 => 19,
                        3 => 16,
                        6 => 14,
                        2 => 11,
                        8 => 4,
                        7 => 4,
                    ],
                'word_lenghts_count' => 7,
                'word_lenghts_weight_count' => 90,
                'sentence_lengths' =>
                    [
                        6 => 5,
                        7 => 5,
                        8 => 2,
                        9 => 1,
                    ],
                'sentence_lenghts_count' => 4,
                'sentence_lenghts_weight_count' => 13,
                'excluded_words' =>
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
                'excluded_words_count' => 43,
            ],
    ];

    expect($modelData)->toBe($expected);
});
