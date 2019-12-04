<?php

declare(strict_types=1);

require_once 'PasswordSolver.php';

$start = microtime(true);

$inputMin = 245318;
$inputMax = 765747;

$solver = new PasswordSolver($inputMin, $inputMax);
$passwordPossibilities = $solver->solve();

$end = microtime(true);

foreach ($passwordPossibilities as $passwordPossibility) {
    echo $passwordPossibility . PHP_EOL;
}

var_dump(count($passwordPossibilities));

echo sprintf('Took: %.2fms', ($end - $start) * 1000);
