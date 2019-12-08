<?php

declare(strict_types=1);


class SpaceImageDecoder
{
    /** @var int[] */
    protected array $data;

    /** @var ImageLayer[] */
    protected array $layers = [];

    /** @var int[] */
    protected array $image = [];

    protected int $layerWidth;
    protected int $layerHeight;

    public function __construct(array $data, int $layerWidth, int $layerHeight)
    {
        $this->data = $data;
        $this->layerWidth = $layerWidth;
        $this->layerHeight = $layerHeight;
    }

    public function process(): array
    {
        $this->createLayers();

        for ($y = 0; $y < $this->layerHeight; ++$y) {
            for ($x = 0; $x < $this->layerWidth; ++$x) {
                foreach ($this->layers as $layer) {
                    $pixel = $layer->getPixel($x, $y);
                    if ($pixel !== 2) {
                        $this->image[$y][$x] = $pixel;
                        break;
                    }
                }
            }
        }

        return $this->image;
    }

    protected function createLayers(): void
    {
        $length = $this->layerHeight * $this->layerWidth;
        for ($i = 0; $i < count($this->data); $i += $length) {
            $layer = new ImageLayer($this->layerWidth, $this->layerHeight);
            $layer->fill(array_slice($this->data, $i, $length));
            $this->layers[] = $layer;
        }
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getLayers(): array
    {
        return $this->layers;
    }

    public function getLayerWidth(): int
    {
        return $this->layerWidth;
    }

    public function setLayerWidth(int $layerWidth): self
    {
        $this->layerWidth = $layerWidth;

        return $this;
    }

    public function getLayerHeight(): int
    {
        return $this->layerHeight;
    }

    public function setLayerHeight(int $layerHeight): self
    {
        $this->layerHeight = $layerHeight;

        return $this;
    }
}