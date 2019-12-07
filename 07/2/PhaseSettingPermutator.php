<?php

declare(strict_types=1);

class PhaseSettingPermutator
{
    public static function getPhaseSettingPermutations(array $phaseSettings): array
    {
        $phaseSettings = array_values($phaseSettings);

        if (count($phaseSettings) === 1) {
            return [$phaseSettings];
        }

        $result = [];
        for ($i = 0; $i < count($phaseSettings); $i++) {
            $copy  = $phaseSettings;
            $value = array_splice($copy, $i, 1);
            foreach (static::getPhaseSettingPermutations($copy) as $permutation) {
                array_unshift($permutation, $value[0]);
                $result[] = $permutation;
            }
        }

        return $result;
    }
}