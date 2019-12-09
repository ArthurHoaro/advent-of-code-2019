<?php

declare(strict_types=1);

class IntCodeInstruction
{
    protected int $position;

    protected ?int $input;

    protected int $type;

    protected string $types;

    /** @var IntCodeAddress[] */
    protected array $addresses;

    public function __construct(
        int $position,
        int $type,
        array $addresses,
        string $types,
        int $input = null,
        int $relativeBase = 0
    ) {
        $this->position = $position;
        $this->type = $type;
        $this->input = $input;
        $this->types = $types;
        $addressTypes = $this->processTypes($types, count($addresses));
        foreach ($addresses as $i => $address) {
            $this->addresses[] = new IntCodeAddress((int) $addressTypes[$i], (int) $address, $relativeBase);
        }
    }

    public function execute(array &$data): ?int
    {
        switch ($this->type) {
            case IntCodeType::TYPE_ADDITION:
                $data[$this->addresses[2]->getRealPosition()] =
                    $this->addresses[0]->getRealValue($data) + $this->addresses[1]->getRealValue($data);
                break;
            case IntCodeType::TYPE_MULTIPLY:
                $data[$this->addresses[2]->getRealPosition()] =
                    $this->addresses[0]->getRealValue($data) * $this->addresses[1]->getRealValue($data);
                break;
            case IntCodeType::TYPE_INPUT:
                $data[$this->addresses[0]->getRealPosition()] = $this->input;
                break;
            case IntCodeType::TYPE_OUTPUT:
                return $this->addresses[0]->getRealValue($data);
            case IntCodeType::TYPE_JUMP_IF_TRUE:
            case IntCodeType::TYPE_JUMP_IF_FALSE:
                if (($this->type === IntCodeType::TYPE_JUMP_IF_TRUE && $this->addresses[0]->getRealValue($data) !== 0)
                    || ($this->type === IntCodeType::TYPE_JUMP_IF_FALSE && $this->addresses[0]->getRealValue($data) === 0)
                ) {
                    throw new ChangePointerException($this->addresses[1]->getRealValue($data));
                }
                break;
            case IntCodeType::TYPE_LESS_THAN:
                if ($this->addresses[0]->getRealValue($data) < $this->addresses[1]->getRealValue($data)) {
                    $data[$this->addresses[2]->getRealPosition()] = 1;
                } else {
                    $data[$this->addresses[2]->getRealPosition()] = 0;
                }
                break;
            case IntCodeType::TYPE_EQUALS:
                if ($this->addresses[0]->getRealValue($data) === $this->addresses[1]->getRealValue($data)) {
                    $data[$this->addresses[2]->getRealPosition()] = 1;
                } else {
                    $data[$this->addresses[2]->getRealPosition()] = 0;
                }
                break;
            case IntCodeType::TYPE_RELATIVE_BASE:
                throw new ChangeRelativeBaseException($this->addresses[0]->getRealValue($data));
                break;
        }

        return null;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAddresses(): array
    {
        return $this->addresses;
    }

    public function setAddresses(array $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    protected function processTypes(string $types, int $nbAddresses): array
    {
        return str_split(str_pad(strrev($types), $nbAddresses, '0'));
    }
}