<?php

declare(strict_types=1);

require_once 'IntCodeComputer.php';
require_once 'IntCodeInstruction.php';
require_once 'IntCodeAddress.php';
require_once 'IntCodeType.php';
require_once 'ChangePointerException.php';
require_once 'PhaseSettingPermutator.php';

const PROVIDED_INPUT = 0;

$line = explode(',', trim('3,15,3,16,1002,16,10,16,1,16,15,15,4,15,99,0,0'));
$line = explode(',', trim('3,23,3,24,1002,24,10,24,1002,23,-1,23,101,5,23,23,1,24,23,23,4,23,99,0,0'));
$line = explode(',', trim('3,31,3,32,1002,32,10,32,1001,31,-2,31,1007,31,0,33,1002,33,7,33,1,33,31,31,1,32,31,31,4,31,99,0,0,0'));
$line = explode(',', trim(file_get_contents('input')));
$referenceValues = array_map(fn (string $line): string => trim($line), $line);

$maxValue = $maxPermutation = null;
foreach (PhaseSettingPermutator::getPhaseSettingPermutations(range(0, 4)) as $permutation) {
    $input = PROVIDED_INPUT;
    foreach ($permutation as $phaseSetting) {
        $computer = new IntCodeComputer($referenceValues, $phaseSetting, $input);
        $input = $computer->processInstructions();

    }
    if ($maxValue === null || $maxValue < $input) {
        $maxValue = $input;
        $maxPermutation = implode(',', $permutation);
    }
}

var_dump($maxValue);
var_dump($maxPermutation);
