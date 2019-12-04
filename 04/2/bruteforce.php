<?php

declare(strict_types=1);

function isValidPassword(string $passCode): bool
{
    $digits = str_split($passCode);
    $multiples = [];
    for ($i = 0; $i < strlen($passCode); ++$i) {
        if (isset($digits[$i + 1]) && $digits[$i] > $digits[$i + 1]) {
            return false;
        }

        $multiples[$digits[$i]] = ($multiples[$digits[$i]] ?? 0) + 1;
    }

    foreach ($multiples as $multiple) {
        if ($multiple === 2) {
            return true;
        }
    }

    return false;
}

$start = microtime(true);

$inputMin = 245318;
$inputMax = 765747;

$passwordPossibilities = [];

for ($i = $inputMin; $i <= $inputMax; ++$i) {
    if (isValidPassword((string) $i)) {
        $passwordPossibilities[] = $i;
    }
}

$end = microtime(true);

foreach ($passwordPossibilities as $passwordPossibility) {
    echo $passwordPossibility . PHP_EOL;
}

var_dump(count($passwordPossibilities));

echo sprintf('Took: %.2fms', ($end - $start) * 1000);
