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

    public function __construct()
    {
        $this->nodes = [];
    }

    public function pushNode(string $parent, string $value): Node
    {
        if (isset($this->nodes[$parent])) {
            $node = new Node($value, $this->nodes[$parent]);

            $this->nodes[$parent]->addChild($node);
        } else {
            $parentNode = new Node($parent);
            $node = new Node($value, $parentNode);

            $this->nodes[$parent] = $parentNode;
            $this->root = $parentNode;
        }

        $this->nodes[$value] = $node;

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