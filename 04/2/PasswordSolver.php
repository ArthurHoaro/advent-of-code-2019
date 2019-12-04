<?php

declare(strict_types=1);

class PasswordSolver
{
    protected int $min;

    protected int $max;

    protected int $startingDigit;

    protected int $maxDigits;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
        $this->startingDigit = (int) str_split((string) $min)[0];
        $this->maxDigits = strlen((string) $min);
    }

    public function solve(): array
    {
        return $this->traverse();
    }

    protected function traverse(array $current = [], int $index = 0): array
    {
        if (count($current) === $this->maxDigits) {
            $currentPassword = (int) implode('', $current);
            return $this->isInbound($currentPassword) && $this->isValid($current) ? [$currentPassword] : [];
        }

        $passwordPossibilities = [];
        for ($i = $current[$index - 1] ?? $this->startingDigit; $i < 10; ++$i) {
            $attempt = $current;
            $attempt[] = $i;
            $passwordPossibilities = array_merge($passwordPossibilities, $this->traverse($attempt, $index + 1));
        }

        return $passwordPossibilities;
    }

    protected function isValid(array $attempt): bool
    {
        foreach (array_count_values($attempt) as $occurrences) {
            if ($occurrences === 2) {
                return true;
            }
        }

        return false;
    }

    protected function isInbound(int $current): bool
    {
        return $this->min <= $current && $this->max >= $current;
    }
}