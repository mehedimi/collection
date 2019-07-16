<?php

namespace Mehedi;

use ArrayIterator;
use IteratorAggregate;
use Mehedi\Exceptions\JSONParseException;

class Collection implements IteratorAggregate
{
    /**
     * Store all items on that array
     *
     * @var array
     */
    protected $items = [];

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Filter items.
     *
     * @param callable $callback
     * @return $this
     */
    public function filter(callable $callback)
    {
        $this->items = array_filter($this->items, $callback);

        return $this;
    }

    /**
     * Insert a new item on collection.
     *
     * @param $item
     * @return $this
     */
    public function push($item)
    {
        array_push($this->items, $item);

        return $this;
    }

    /**
     * Remove last item and returned it.
     *
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->items);
    }

    /**
     * Return all items.
     *
     * @return array
     */
    public function all()
    {
        return $this->toArray();
    }

    /**
     * Cast into array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_values($this->items);
    }

    /**
     * It parse into JSON Object.
     *
     * @return false|string
     * @throws JSONParseException
     */
    public function toJSON()
    {
        $json = json_encode($this->items);

        if (json_last_error() != JSON_ERROR_NONE) {

            throw new JSONParseException();
        }

        return $json;
    }

    /**
     * Merge array or collection instance.
     *
     * @param $item array|Collection
     * @return $this
     */
    public function merge($item)
    {
        $this->items = array_merge($this->items, $this->getCastedItem($item));

        return $this;
    }

    /**
     * Get item in array.
     *
     * @param $item
     * @return array
     */
    protected function getCastedItem($item)
    {
        if ($item instanceof self) {
            return $item->toArray();
        }

        return (array) $item;
    }
}
