<?php

declare(strict_types=1);

class IntCodeComputer
{
    protected array $data;

    /** @var IntCodeInstruction[] */
    protected array $instructions;

    protected int $phaseSetting;

    protected int $position;

    protected bool $hadPhaseSetting = false;

    public function __construct(array $data, int $phaseSetting)
    {
        $this->data = array_map(fn (string $item): int => (int) $item, $data);
        $this->phaseSetting = $phaseSetting;
        $this->position = 0;
    }

    public function processInstructions(int $input): int
    {
        while($this->position < count($this->data)) {
            $currentInput = null;
            $instructions = [];
            $opCode = (string) $this->data[$this->position];
            $type = strlen($opCode) > 2 ? (int) substr($opCode, -2) : $this->data[$this->position];
            $addressTypes = strlen($opCode) > 2 ? substr($opCode, 0, -2) : '';

            if ($type === IntCodeType::TYPE_EXIT) {
                throw new ComputerHaltsException($this->phaseSetting);
            }

            if ($type === IntCodeType::TYPE_INPUT) {
                $currentInput = $this->hadPhaseSetting === false ? $this->phaseSetting : $input;
                $this->hadPhaseSetting = true;
            }

            for ($k = 1; $k < IntCodeType::getTypeNumberOfInstructions($type) + 1; ++$k) {
                $instructions[] = (int) $this->data[$k + $this->position];
            }

            $instruction = new IntCodeInstruction($this->position, $type, $instructions, $addressTypes, $currentInput);
            try {
                $result = $instruction->execute($this->data);
            } catch (ChangePointerException $e) {
                $this->position = $e->getPosition();
                continue;
            }

            $this->position += $k;

            if ($type === IntCodeType::TYPE_OUTPUT) {
                return $result;
            }
        }

        return null;
    }
}