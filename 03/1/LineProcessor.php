<?php

declare(strict_types=1);

class LineProcessor
{
    protected array $grid = [];

    protected array $crosses = [];

    public function processLine(int $wire, array $moves): void
    {
        $x = 0;
        $y = 0;

        foreach ($moves as $move) {
            list($direction, $distance) = preg_split('/(?<=.{1})/', $move, 2);

            for ($i = 0; $i < $distance; ++$i) {
                if ($direction === 'U') {
                    $x += 1;
                } elseif ($direction === 'D') {
                    $x -= 1;
                } elseif ($direction === 'L') {
                    $y -= 1;
                } elseif ($direction === 'R') {
                    $y += 1;
                }

                if (isset($this->grid[$x][$y]) && !isset($this->grid[$x][$y][$wire])) {
                    $this->crosses[$x][$y][$wire] = true;
                }
                $this->grid[$x][$y][$wire] = true;
            }
        }
    }

    public function getClosest(): ?int
    {
        $min = null;
        foreach ($this->crosses as $x => $values) {
            foreach ($values as $y => $bool) {
                $distance = abs($x) + abs($y);
                $min = $min === null || $distance < $min ? $distance : $min;
            }
        }

        return $min;
    }

    public function getCrosses(): array
    {
        return $this->crosses;
    }
}
