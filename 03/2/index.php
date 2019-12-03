<?php

declare(strict_types=1);

require_once 'LineProcessor.php';

$lines = 'R75,D30,R83,U83,L12,D49,R71,U7,L72'. PHP_EOL .'U62,R66,U55,R34,D71,R55,D58,R83';

$lines = 'R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51'. PHP_EOL .'U98,R91,D20,R16,D67,R40,U7,R15,U6,R7';

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
var_dump($processor->getFewestSteps());
