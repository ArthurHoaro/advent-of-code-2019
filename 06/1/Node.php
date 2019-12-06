<?php

declare(strict_types=1);

class Node
{
    protected string $value;

    protected ?Node $parent;

    protected array $children;

    public function __construct(string $value, Node $parent = null)
    {
        $this->value = $value;
        $this->parent = $parent;
        $this->children = [];
    }

    public function isRoot(): bool
    {
        return $this->parent === null;
    }

    public function isLeaf(): bool
    {
        return count($this->children) === 0;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getParent(): ?Node
    {
        return $this->parent;
    }

    public function setParent(?Node $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChild(Node $node): self
    {
        $this->children[] = $node;

        return $this;
    }

    public function setChildren(array $children): self
    {
        $this->children = $children;

        return $this;
    }


}