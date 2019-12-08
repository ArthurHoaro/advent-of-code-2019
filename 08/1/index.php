<?php

declare(strict_types=1);

require_once 'SpaceImageDecoder.php';
require_once 'ImageLayer.php';

//const PROVIDED_WIDTH = 3;
//const PROVIDED_HEIGHT = 2;
const PROVIDED_WIDTH = 25;
const PROVIDED_HEIGHT = 6;

$line = str_split('123456789012');
$line = str_split(trim(file_get_contents('input')));
$values = array_map('intval', $line);

$decoder = new SpaceImageDecoder($values, PROVIDED_WIDTH, PROVIDED_HEIGHT);
$layers = $decoder->process();

$min = $minLayer = null;
foreach ($layers as $layer) {
    $occurrences = $layer->getOccurrences(0);
    if ($min === null || $min > $occurrences) {
        $min = $occurrences;
        $minLayer = $layer;
    }
}

var_dump($minLayer->getOccurrences(1) * $minLayer->getOccurrences(2));
