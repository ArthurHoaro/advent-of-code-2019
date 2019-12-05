<?php

declare(strict_types=1);

class IntCodeComputer
{
    protected array $instructions;

    public function __construct(array $input)
    {
        $this->instructions = $this->splitInputIntoInstructions($input);
    }

    protected function processInstructions(array $input): array
    {
        for ($i = 0; $i < count($input);) {
            $instructions = [];
            $type = strlen($input[$i]) > 2 ? (int) substr($input[$i], 0, -2) : (int) $input[$i];

            if ($type === 99) {
                break;
            }

            for ($k = 1; $k < IntCodeType::getTypeNumberOfInstructions($type) + 1; ++$k) {
                $instructions[] = (int) $input[$k + $i];
            }
            $i += $k;

            $this->instructions[] = new IntCodeInstruction($type, $instructions);
        }
    }
}