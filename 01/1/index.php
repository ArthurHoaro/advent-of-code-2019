<?php

declare(strict_types=1);

$line = array_filter(explode(PHP_EOL, file_get_contents('input')));
$masses = array_map(fn (string $line): int => (int) trim($line), $line);

$fuelRequired = 0;

foreach ($masses as $mass) {
    $fuelRequired += floor($mass / 3) - 2;
}

echo 'Required fuel to GO: '. $fuelRequired . PHP_EOL;
