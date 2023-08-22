<?php

declare(strict_types=1);

use Phonyland\LanguageModel\LookupList;

beforeEach(function (): void {
    $this->lookupList = (new LookupList())
        ->addElement('one')
        ->addElement('two')
        ->addElement('two')
        ->addElement('three')
        ->addElement('three')
        ->addElement('three')
        ->addElement('four')
        ->addElement('four')
        ->addElement('four')
        ->addElement('four')
        ->addElement('five')
        ->addElement('five')
        ->addElement('five')
        ->addElement('five')
        ->addElement('five')
        ->calculate()
        ->toArray();
});

it('has an element index', function (): void {
    expect($this->lookupList['e'])->toEqual([
        0 => 'one',
        1 => 'two',
        2 => 'three',
        3 => 'four',
        4 => 'five',
    ]);
});

it('has a weight index', function (): void {
    expect($this->lookupList['w'])->toEqual([
        0 => 1,
        1 => 2,
        2 => 3,
        3 => 4,
        4 => 5,
    ]);
});

it('has a cumulative weight index', function (): void {
    expect($this->lookupList['cw'])->toEqual([
        0 => 1,
        1 => 3,
        2 => 6,
        3 => 10,
        4 => 15,
    ]);
});

it('has a index elements', function (): void {
    expect($this->lookupList['i'])->toEqual([
        'one'   => 0,
        'two'   => 1,
        'three' => 2,
        'four'  => 3,
        'five'  => 4,
    ]);
});

it('has the sum of weights', function (): void {
    expect($this->lookupList['sw'])->toEqual(15);
});

it('has the number of elements', function (): void {
    expect($this->lookupList['c'])->toEqual(5);
});
