<?php

declare(strict_types=1);

class IntCodeType
{
    public const TYPE_ADDITION = 1;
    public const TYPE_MULTIPLY = 2;
    public const TYPE_INPUT = 3;
    public const TYPE_OUTPUT = 4;

    public static function getTypeNumberOfInstructions(int $type): int
    {
        switch ($type) {
            case static::TYPE_ADDITION:
            case static::TYPE_MULTIPLY:
                return 3;
            case static::TYPE_INPUT:
            case static::TYPE_OUTPUT:
                return 1;
            default:
                throw new Exception('unknow IntCodeType');
        }
    }
}