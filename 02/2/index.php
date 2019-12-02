<?php

declare(strict_types=1);

function process_position(int $position, array $values): array
{
    $a = $values[$values[$position + 1]];
    $b = $values[$values[$position + 2]];
    $destination = $values[$position + 3];
    if ($values[$position] === 1) {
        $values[$destination] = $a + $b;
    } elseif ($values[$position] === 2) {
        $values[$destination] = $a * $b;
    }

    return $values;
}

$line = explode(',', trim(file_get_contents('input')));
$referenceValues = array_map(fn (string $line): int => (int) trim($line), $line);

const EXPECTED_RESULT = 19690720;

for ($i = 0; $i < 100; ++$i) {
    for ($y = 0; $y < 100; ++$y) {
        $values = $referenceValues;
        $values[1] = $i;
        $values[2] = $y;

        $position = 0;
        while ($values[$position] !== 99) {
            $values = process_position($position, $values);
            $position += 4;
        }

        $result = $values[0];
        echo 'Found result: '. $result .' [expected='. EXPECTED_RESULT .']'. PHP_EOL;
        if ($result === EXPECTED_RESULT) {
            echo 'Found expected result with noun: '. $i . ' - verb: '. $y .' - result: '. (100*$i+$y). PHP_EOL;

            exit(0);
        }
    }
}

echo 'No result found.'. PHP_EOL;;