<?php

declare(strict_types=1);

class IntCodeComputer
{
    protected array $data;

    /** @var IntCodeInstruction[] */
    protected array $instructions;

    /** @var int */
    protected int $phaseSetting;

    /** @var int */
    protected int $input;

    public function __construct(array $data, int $phaseSetting, int $input)
    {
        $this->data = array_map(fn (string $item): int => (int) $item, $data);
        $this->input = $input;
        $this->phaseSetting = $phaseSetting;
    }

    public function processInstructions(): ?int
    {
        $output = null;
        $hadPhaseSetting = false;
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
                $input = $hadPhaseSetting === false ? $this->phaseSetting : $this->input;
                $hadPhaseSetting = true;
            }

            for ($k = 1; $k < IntCodeType::getTypeNumberOfInstructions($type) + 1; ++$k) {
                $instructions[] = (int) $this->data[$k + $i];
            }

            $instruction = new IntCodeInstruction($i, $type, $instructions, $addressTypes, $input);
            try {
                $result = $instruction->execute($this->data);
            } catch (ChangePointerException $e) {
                $i = $e->getPosition();
                continue;
            }
            $output = $result ?? $output;

            $i += $k;
        }

        return $output;
    }
}