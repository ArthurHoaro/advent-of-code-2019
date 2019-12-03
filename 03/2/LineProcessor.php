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
        $step = 0;

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
                $this->grid[$x][$y][$wire] = ++$step;
            }
        }
    }

    public function getFewestSteps(): ?int
    {
        $min = null;
        foreach ($this->crosses as $x => $values) {
            foreach ($values as $y => $bool) {
                $steps = $this->grid[$x][$y][0] + $this->grid[$x][$y][1];
                $min = $min === null || $steps < $min ? $steps : $min;
            }
        }

        return $min;
    }

    public function getCrosses(): array
    {
        return $this->crosses;
    }
}
