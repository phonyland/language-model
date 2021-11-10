<?php

declare(strict_types=1);

use Phonyland\LanguageModel\Element;

it('has an element index', function (): void {
    $element = new Element('foo');

    $element->addChildren('bar');
    $element->addChildren('bar');
    $element->addChildren('taz');
    $element->addLastChildren('baz');
    $element->addLastChildren('baz');
    $element->addLastChildren('yaz');

    $elementData = $element->calculate()->toArray();

    expect($elementData)->toHaveKeys([
        'c',
        'lc'
    ]);
});
