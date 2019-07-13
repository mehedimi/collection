<?php

namespace Mehedi;

use ArrayIterator;
use IteratorAggregate;

class Collection implements IteratorAggregate
{
    protected $items = [];

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    public function filter(callable $callback)
    {
        $this->items = array_filter($this->items, $callback);

        return $this;
    }

    public function push($item)
    {
        array_push($this->items, $item);

        return $this;
    }

    public function pop()
    {
        return array_pop($this->items);
    }

    public function all()
    {
        return array_values($this->items);
    }
}