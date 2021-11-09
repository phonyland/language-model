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
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'ck' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'ck' => 4,
                                    ],
                                'lcl' =>
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
                                'lcl' =>
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
                                'cl' =>
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
                                'cl' =>
                                    [
                                        'rt' => 4,
                                        'rd' => 6,
                                    ],
                                'cc' => 2,
                                'cwc' => 6,
                                'lc' =>
                                    [
                                        'rf' => 1,
                                    ],
                                'lcl' =>
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
                                'lcl' =>
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
                                'lcl' =>
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
                                'lcl' =>
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
                                'cl' =>
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
                                'cl' =>
                                    [
                                        'ox' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'ox' => 2,
                                    ],
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'ra' => 2,
                                        'ro' => 3,
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
                                'cl' =>
                                    [
                                        'kl' => 2,
                                        'kd' => 4,
                                    ],
                                'cc' => 2,
                                'cwc' => 4,
                                'lc' =>
                                    [
                                        'ks' => 1,
                                    ],
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'af' => 2,
                                        'aw' => 4,
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
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'oz' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'og' => 1,
                                    ],
                                'lcl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'li' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        'ly' => 2,
                                    ],
                                'lcl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'ck' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'ck' => 4,
                                    ],
                                'lcl' =>
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
                                'cl' =>
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
                                'lcl' =>
                                    [
                                        'nx' => 4,
                                        'ng' => 6,
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
                                'cl' =>
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
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        've' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        've' => 4,
                                    ],
                                'lcl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
                                    [
                                        'um' => 5,
                                        'ud' => 7,
                                        'ug' => 9,
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
                                'cl' =>
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
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'ac' => 2,
                                        'az' => 3,
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
                                'cl' =>
                                    [
                                        'iq' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'ib' => 1,
                                    ],
                                'lcl' =>
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
                                'cl' =>
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
                                'lcl' =>
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
                                'lcl' =>
                                    [
                                        'ph' => 2,
                                        'ps' => 3,
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
                                    [
                                        've' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        've' => 2,
                                    ],
                                'lcl' =>
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
                                'lcl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
                                    [
                                        'ui' => 7,
                                        'ua' => 11,
                                        'uo' => 13,
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
                                'cl' =>
                                    [
                                        'ab' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        'as' => 2,
                                    ],
                                'lcl' =>
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
                                'lcl' =>
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
                                'cl' =>
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
                                'lcl' =>
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
                                'cl' =>
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
                                'lcl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'ic' => 6,
                                    ],
                                'cc' => 1,
                                'cwc' => 6,
                                'lc' =>
                                    [
                                        'iz' => 1,
                                    ],
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'mp' => 1,
                                    ],
                                'cc' => 1,
                                'cwc' => 1,
                                'lc' =>
                                    [
                                        'mp' => 4,
                                    ],
                                'lcl' =>
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
                                'lcl' =>
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
                                'cl' =>
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
                                'lcl' =>
                                    [
                                        'er' => 1,
                                        'ed' => 2,
                                        'ex' => 3,
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
                                'lcl' =>
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
                                'cl' =>
                                    [
                                        'al' => 1,
                                        'ar' => 2,
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
                                'cl' =>
                                    [
                                        'iz' => 2,
                                        'it' => 4,
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
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
                                'cl' =>
                                    [
                                        'eb' => 2,
                                    ],
                                'cc' => 1,
                                'cwc' => 2,
                                'lc' =>
                                    [
                                        'en' => 2,
                                    ],
                                'lcl' =>
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
                'first_elements_lookup' =>
                    [
                        'qu' => 11,
                        'ju' => 20,
                        'my' => 26,
                        'th' => 30,
                        'sp' => 34,
                        'of' => 38,
                        'fi' => 42,
                        'bo' => 46,
                        'wi' => 50,
                        'do' => 53,
                        've' => 56,
                        'fo' => 58,
                        'ny' => 60,
                        'bl' => 62,
                        'vo' => 64,
                        'ho' => 66,
                        'da' => 68,
                        'ze' => 70,
                        'ja' => 72,
                        'lo' => 74,
                        'bi' => 76,
                        'pa' => 78,
                        'li' => 80,
                        'br' => 81,
                        'ov' => 82,
                        'la' => 83,
                        'ji' => 84,
                        'gr' => 85,
                        'wa' => 86,
                        'gl' => 87,
                        'jo' => 88,
                        'to' => 89,
                        'dw' => 90,
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
                'sentence_elements_lookup' =>
                    [
                        1 =>
                            [
                                'th' => 3,
                                'sp' => 5,
                                'ho' => 7,
                                'ja' => 9,
                                'pa' => 11,
                                'ji' => 12,
                                'gl' => 13,
                            ],
                        2 =>
                            [
                                'of' => 2,
                                've' => 4,
                                'fi' => 6,
                                'lo' => 8,
                                'my' => 10,
                                'qu' => 11,
                                'fo' => 12,
                                'jo' => 13,
                            ],
                        3 =>
                            [
                                'bo' => 4,
                                'qu' => 7,
                                'bl' => 9,
                                'my' => 11,
                                'br' => 12,
                                'ny' => 13,
                            ],
                        -3 =>
                            [
                                'ju' => 2,
                                'da' => 4,
                                'wi' => 6,
                                'sp' => 8,
                                'do' => 10,
                                'th' => 11,
                                'gr' => 12,
                                'to' => 13,
                            ],
                        -2 =>
                            [
                                'my' => 2,
                                'ze' => 4,
                                'ju' => 6,
                                'of' => 8,
                                'li' => 10,
                                'la' => 11,
                                'qu' => 12,
                                've' => 13,
                            ],
                        -1 =>
                            [
                                'ju' => 4,
                                'qu' => 8,
                                'vo' => 10,
                                'do' => 11,
                                'wa' => 12,
                                'dw' => 13,
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
                'word_lengths_lookup' =>
                    [
                        4 => 22,
                        5 => 41,
                        3 => 57,
                        6 => 71,
                        2 => 82,
                        8 => 86,
                        7 => 90,
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
