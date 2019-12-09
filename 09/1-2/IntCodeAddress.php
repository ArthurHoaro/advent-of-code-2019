<?php

declare(strict_types=1);


class IntCodeAddress
{
    public const ADDRESS_TYPE_POSITION = 0;
    public const ADDRESS_TYPE_IMMEDIATE = 1;
    public const ADDRESS_TYPE_RELATIVE = 2;

    protected int $type;

    protected int $value;

    protected int $relativeBase;

    public function __construct(int $type, int $value, int $relativeBase)
    {
        $this->type = $type;
        $this->value = $value;
        $this->relativeBase = $relativeBase;
    }

    public function getRealValue(array $input): int
    {
        if ($this->getType() === static::ADDRESS_TYPE_POSITION) {
            return $input[$this->getValue()];
        }
        if ($this->getType() === static::ADDRESS_TYPE_RELATIVE) {
            return $input[$this->getValue() + $this->relativeBase];
        }
        return $this->getValue();
    }

    public function getRealPosition(): int
    {
        if ($this->getType() === static::ADDRESS_TYPE_RELATIVE) {
            return $this->getValue() + $this->relativeBase;
        }

        return $this->getValue();
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

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }
}