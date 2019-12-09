<?php

declare(strict_types=1);

class ComputerHaltsException extends Exception
{
    protected int $phaseSetting;

    public function __construct(int $phaseSetting)
    {
        $this->phaseSetting = $phaseSetting;
    }

    public function getPhaseSetting(): int
    {
        return $this->phaseSetting;
    }
}