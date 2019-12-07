<?php

declare(strict_types=1);

class ChangePointerException extends Exception
{
    /** @var int */
    protected int $position;

    public function __construct(int $position)
    {
        $this->position = $position;
    }

    public function getPosition(): int
    {
        return $this->position;
    }
}