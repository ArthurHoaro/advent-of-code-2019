<?php

declare(strict_types=1);

function isValidPassword(string $passCode): bool
{
    $digits = str_split($passCode);
    $hasDouble = false;
    for ($i = 0; $i < strlen($passCode) - 1; ++$i) {
        if ($digits[$i] > $digits[$i + 1]) {
            return false;
        }

        if ($digits[$i] === $digits[$i + 1]) {
            $hasDouble = true;
        }
    }

    return $hasDouble;
}

$inputMin = 245318;
$inputMax = 765747;

$passwordPossibilities = 0;

for ($i = $inputMin; $i <= $inputMax; ++$i) {
    $passwordPossibilities += isValidPassword((string) $i) ? 1 : 0;
}

var_dump($passwordPossibilities);
