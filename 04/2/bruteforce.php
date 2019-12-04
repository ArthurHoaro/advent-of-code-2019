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

$inputMin = 245318;
$inputMax = 765747;

$passwordPossibilities = 0;

for ($i = $inputMin; $i <= $inputMax; ++$i) {
    $passwordPossibilities += isValidPassword((string) $i) ? 1 : 0;
}

var_dump($passwordPossibilities);
