<?php

declare(strict_types=1);

require_once 'IntCodeComputer.php';
require_once 'IntCodeInstruction.php';
require_once 'IntCodeType.php';

$line = explode(',', trim(file_get_contents('input')));
$referenceValues = array_map(fn (string $line): string => trim($line), $line);

$computer = new IntCodeComputer($referenceValues);
