<?php

declare(strict_types=1);

require_once 'IntCodeComputer.php';
require_once 'IntCodeInstruction.php';
require_once 'IntCodeAddress.php';
require_once 'IntCodeType.php';
require_once 'ChangeRelativeBaseException.php';
require_once 'ChangePointerException.php';
require_once 'ComputerHaltsException.php';

const PROVIDED_INPUT = 1;

$line = explode(',', trim('109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99'));
$line = explode(',', trim('1102,34915192,34915192,7,4,7,99,0'));
$line = explode(',', trim('104,1125899906842624,99'));
$line = explode(',', trim(file_get_contents('input')));
$referenceValues = array_map(fn (string $line): string => trim($line), $line);

$computer = new IntCodeComputer($referenceValues, 0);

try {
    $result = $computer->processInstructions(PROVIDED_INPUT);
} catch (ComputerHaltsException $e) {
    echo 'THE END'. PHP_EOL;
}

var_dump(implode(',', $computer->getData()));
var_dump($result);
