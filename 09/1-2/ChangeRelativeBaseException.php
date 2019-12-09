<?php

declare(strict_types=1);

class ChangeRelativeBaseException extends Exception
{
    protected int $relativeBase;

    public function __construct(int $phaseSetting)
    {
        $this->relativeBase = $phaseSetting;
    }

    public function getRelativeBase(): int
    {
        return $this->relativeBase;
    }
}