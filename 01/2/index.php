<?php

declare(strict_types=1);

function calculate_fuel_required(int $mass, int $fuel = 0): int
{
    $additionalFuel = (int) floor($mass / 3) - 2;

    if ($additionalFuel <= 0) {
        return $fuel;
    }

    return calculate_fuel_required($additionalFuel, $fuel + $additionalFuel);
}

$line = array_filter(explode(PHP_EOL, file_get_contents('input')));
$masses = array_map(fn (string $line): int => (int) trim($line), $line);

$fuelRequired = 0;

foreach ($masses as $mass) {
    $fuelRequired += calculate_fuel_required($mass);
}

echo 'Required fuel to GO: '. $fuelRequired . PHP_EOL;
