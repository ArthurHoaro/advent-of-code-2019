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

    public function getDistanceToSanta(): int
    {
        $i = 0;
        $distanceMeToCom = [];
        $node = $this->nodes['YOU'];

        while ($node->isRoot() === false && ++$i) {
            $node = $node->getParent();
            $distanceMeToCom[$node->getValue()] = $i;
        }

        $i = 0;
        $node = $this->nodes['SAN'];
        while ($node->isRoot() === false && ++$i) {
            $node = $node->getParent();
            if (isset($distanceMeToCom[$node->getValue()])) {
                return $distanceMeToCom[$node->getValue()] + $i - 2;
            }
        }

        throw new Exception('Distance not found');
    }
}