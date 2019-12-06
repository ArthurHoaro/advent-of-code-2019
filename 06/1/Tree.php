<?php

declare(strict_types=1);

class Tree
{
    /**
     * @var Node[]
     * We assume for now that each node has a unique value
     */
    protected array $nodes;

    protected ?Node $root = null;

    public function __construct(string $parentValue)
    {
        $this->root = new Node($parentValue);
        $this->nodes = [];
        $this->nodes[] = $this->root;
    }

    public function pushNode(string $parent, string $value): Node
    {
        if (!isset($this->nodes[$parent])) {
            $this->nodes[$parent] = new Node($parent);
        }

        if (!isset($this->nodes[$value])) {
            $this->nodes[$value] = new Node($value, $this->nodes[$parent]);
        }

        $this->nodes[$parent]->addChild($this->nodes[$value]);
        $this->nodes[$value]->setParent($this->nodes[$parent]);

        return $this->nodes[$value];
    }

    public function countAllDistances(): int
    {
        $distance = 0;

        foreach ($this->nodes as $node) {
            while ($node->isRoot() === false) {
                $distance++;
                $node = $node->getParent();
            }
        }

        return $distance;
    }
}