<?php

declare(strict_types=1);

class IntCodeComputer
{
    protected array $data;

    /** @var IntCodeInstruction[] */
    protected array $instructions;

    /** @var int */
    protected int $input;

    public function __construct(array $data, int $input)
    {
        $this->data = array_map(fn (string $item): int => (int) $item, $data);
        $this->input = $input;
    }

    public function processInstructions(): ?int
    {
        $output = null;
        for ($i = 0; $i < count($this->data);) {
            $input = null;
            $instructions = [];
            $opCode = (string) $this->data[$i];
            $type = strlen($opCode) > 2 ? (int) substr($opCode, -2) : $this->data[$i];
            $addressTypes = strlen($opCode) > 2 ? substr($opCode, 0, -2) : '';

            if ($type === IntCodeType::TYPE_EXIT) {
                break;
            }

            if ($type === IntCodeType::TYPE_INPUT) {
                $input = $this->input;
            }

            for ($k = 1; $k < IntCodeType::getTypeNumberOfInstructions($type) + 1; ++$k) {
                $instructions[] = (int) $this->data[$k + $i];
            }
            $i += $k;

            $instruction = new IntCodeInstruction($type, $instructions, $addressTypes, $input);
            $result = $instruction->execute($this->data);
            $output = $result ?? $output;
        }

        return $output;
    }
}