<?php

declare(strict_types=1);

require_once 'IntCodeComputer.php';
require_once 'IntCodeInstruction.php';
require_once 'IntCodeAddress.php';
require_once 'IntCodeType.php';
require_once 'PhaseSettingPermutator.php';
require_once 'ChangePointerException.php';
require_once 'ComputerHaltsException.php';

const PROVIDED_INPUT = 0;

$line = explode(',', trim('3,26,1001,26,-4,26,3,27,1002,27,2,27,1,27,26,27,4,27,1001,28,-1,28,1005,28,6,99,0,0,5'));
$line = explode(',', trim('3,52,1001,52,-5,52,3,53,1,52,56,54,1007,54,5,55,1005,55,26,1001,54,-5,54,1105,1,12,1,53,54,53,1008,54,0,55,1001,55,1,55,2,53,55,53,4,53,1001,56,-1,56,1005,56,6,99,0,0,0,0,10'));
$line = explode(',', trim(file_get_contents('input')));
$referenceValues = array_map(fn (string $line): string => trim($line), $line);

$maxValue = $maxPermutation = null;
foreach (PhaseSettingPermutator::getPhaseSettingPermutations(range(5, 9)) as $permutation) {
    $input = PROVIDED_INPUT;
    $computers = [];
    $result = 0;
    foreach ($permutation as $phaseSetting) {
        $computers[] = new IntCodeComputer($referenceValues, $phaseSetting);
    }

    try {
        for ($i = 0;; $i = ($i + 1) % 5) {
            $input = $computers[$i]->processInstructions($input);
        }
    } catch (ComputerHaltsException $e) {}

    if ($maxValue === null || $maxValue < $input) {
        $maxValue = $input;
        $maxPermutation = implode(',', $permutation);
    }
}

var_dump($maxValue);
var_dump($maxPermutation);
