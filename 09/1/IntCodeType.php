<?php

declare(strict_types=1);

class IntCodeType
{
    public const TYPE_ADDITION = 1;
    public const TYPE_MULTIPLY = 2;
    public const TYPE_INPUT = 3;
    public const TYPE_OUTPUT = 4;
    public const TYPE_JUMP_IF_TRUE = 5;
    public const TYPE_JUMP_IF_FALSE = 6;
    public const TYPE_LESS_THAN = 7;
    public const TYPE_EQUALS = 8;
    public const TYPE_RELATIVE_BASE = 9;
    public const TYPE_EXIT = 99;

    public static function getTypeNumberOfInstructions(int $type): int
    {
        switch ($type) {
            case static::TYPE_INPUT:
            case static::TYPE_OUTPUT:
            case static::TYPE_RELATIVE_BASE:
                return 1;
            case static::TYPE_JUMP_IF_TRUE:
            case static::TYPE_JUMP_IF_FALSE:
                return 2;
            case static::TYPE_ADDITION:
            case static::TYPE_MULTIPLY:
            case static::TYPE_LESS_THAN:
            case static::TYPE_EQUALS:
                return 3;
            default:
                throw new Exception('unknown IntCodeType '. $type);
        }
    }
}