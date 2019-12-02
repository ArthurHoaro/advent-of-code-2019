<?php

declare(strict_types=1);

$line = explode(',', trim(file_get_contents('input')));
$values = array_map(fn (string $line): int => (int) trim($line), $line);

$position = 0;
while ($values[$position] !== 99) {
    $a = $values[$values[$position + 1]];
    $b = $values[$values[$position + 2]];
    $destination = $values[$position + 3];
    if ($values[$position] === 1) {
        $values[$destination] = $a + $b;
    } elseif ($values[$position] === 2) {
        $values[$destination] = $a * $b;
    }

    $position += 4;
}

var_dump($values);
echo 'New value of the first position is: '. $values[0];
