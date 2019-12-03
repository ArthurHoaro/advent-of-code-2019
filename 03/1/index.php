<?php

declare(strict_types=1);

require_once 'LineProcessor.php';

$lines = 'R8,U5,L5,D3'. PHP_EOL .'U7,R6,D4,L4';

$lines = 'R75,D30,R83,U83,L12,D49,R71,U7,L72'. PHP_EOL .'U62,R66,U55,R34,D71,R55,D58,R83';

$lines = file_get_contents('input');

$lines = array_filter(explode(PHP_EOL, trim($lines)));
$wiresMoves = [];

foreach ($lines as $key => $line) {
    $wiresMoves[$key] = array_map(fn (string $line): string => trim($line), explode(',', $line));
}

$processor = new LineProcessor();

foreach ([0, 1] as $wire) {
    $processor->processLine($wire, $wiresMoves[$wire]);
}

var_dump($processor->getCrosses());
var_dump($processor->getClosest());
