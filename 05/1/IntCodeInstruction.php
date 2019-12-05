<?php

declare(strict_types=1);

class IntCodeInstruction
{
    protected ?int $input;

    protected int $type;

    /** @var IntCodeAddress[] */
    protected array $addresses;

    public function __construct(int $type, array $addresses, string $types, ?int $input)
    {
        $this->type = $type;
        $this->input = $input;
        $addressTypes = $this->processTypes($types, count($addresses));
        foreach ($addresses as $i => $address) {
            $this->addresses[] = new IntCodeAddress((int) $addressTypes[$i], (int) $address);
        }
    }

    public function execute(array &$data): ?int
    {
        switch ($this->type) {
            case IntCodeType::TYPE_ADDITION:
                $data[$this->addresses[2]->getValue()] =
                    $this->addresses[0]->getRealValue($data) + $this->addresses[1]->getRealValue($data);
                break;
            case IntCodeType::TYPE_MULTIPLY:
                $data[$this->addresses[2]->getValue()] =
                    $this->addresses[0]->getRealValue($data) * $this->addresses[1]->getRealValue($data);
                break;
            case IntCodeType::TYPE_INPUT:
                $data[$this->addresses[0]->getValue()] = $this->input;
                break;
            case IntCodeType::TYPE_OUTPUT:
                return $data[$this->addresses[0]->getValue()];
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