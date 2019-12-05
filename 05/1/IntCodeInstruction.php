<?php

declare(strict_types=1);

class IntCodeInstruction
{
    protected int $type;

    protected array $addresses;

    public function __construct(int $type, array $addresses)
    {
        $this->type = $type;
        $this->addresses = $addresses;
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
}