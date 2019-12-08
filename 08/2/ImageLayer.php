<?php

declare(strict_types=1);

class ImageLayer
{
    /** @var int[] */
    protected array $data;

    /** @var int[] */
    protected $occurrences;

    protected int $width;
    protected int $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function fill(array $data): void
    {
        for ($y = 0; $y < $this->height; ++$y) {
            for ($x = 0; $x < $this->width; ++$x) {
                $position = $y * $this->width + $x;
                if (!isset($data[$x+$y])) {
                    throw new Exception('invalid dimensions');
                }

                $this->data[$y][$x] = $data[$position];
                $this->occurrences[$data[$position]] = ($this->occurrences[$data[$position]] ?? 0) + 1;
            }
        }
    }

    public function getOccurrences(int $value): int
    {
        return $this->occurrences[$value] ?? 0;
    }

    public function getPixel(int $x, int $y): int
    {
        return $this->data[$y][$x];
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }
}