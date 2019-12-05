<?php

declare(strict_types=1);

require_once 'IntCodeComputer.php';
require_once 'IntCodeInstruction.php';
require_once 'IntCodeAddress.php';
require_once 'IntCodeType.php';
require_once 'ChangePointerException.php';

const PROVIDED_INPUT = 5;

$line = explode(',', trim('3,9,8,9,10,9,4,9,99,-1,8'));
$line = explode(',', trim('3,9,7,9,10,9,4,9,99,-1,8'));
$line = explode(',', trim('3,3,1108,-1,8,3,4,3,99'));
$line = explode(',', trim('3,3,1107,-1,8,3,4,3,99'));
$line = explode(',', trim('3,12,6,12,15,1,13,14,13,4,13,99,-1,0,1,9'));
$line = explode(',', trim('3,3,1105,-1,9,1101,0,0,12,4,12,99,1'));
$line = explode(',', trim(file_get_contents('input')));
$referenceValues = array_map(fn (string $line): string => trim($line), $line);

$computer = new IntCodeComputer($referenceValues, PROVIDED_INPUT);
$processed = $computer->processInstructions();

var_dump($processed);
