<?php

declare(strict_types=1);

require_once 'IntCodeComputer.php';
require_once 'IntCodeInstruction.php';
require_once 'IntCodeAddress.php';
require_once 'IntCodeType.php';

const PROVIDED_INPUT = 1;

//$line = explode(',', trim(file_get_contents('demo')));
$line = explode(',', trim(file_get_contents('input')));
$referenceValues = array_map(fn (string $line): string => trim($line), $line);

$computer = new IntCodeComputer($referenceValues, PROVIDED_INPUT);
$processed = $computer->processInstructions();

var_dump($processed);
