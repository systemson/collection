<?php

namespace Amber\Collection\Base;

use Ds\Collection as CollectionInterface;

/**
 * Implements the basis for the Collection.
 */
trait Essential
{
    /**
     * Returns a new collection.
     *
     * @param array $array The items for the new collection.
     *
     * @return static a new Instance of the collection.
     */
    public function make($array = [])
    {
        return new static($array);
    }

    /**
     * Returns an array of the collection.
     *
     * @return array The items in the collection.
     */
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * Returns an json representation of the collection.
     *
     * @return string The json representation of the collection.
     */
    public function toJson(): string
    {
        return json_encode($this->getArrayCopy());
    }

    /**
     * Alias for toArray().
     *
     * @return array The items in the collection.
     */
    public function all(): array
    {
        return $this->toArray();
    }

    /**
     * Creates a shallow copy of the collection.
     *
     * @return Collection a shallow copy of the collection.
     */
    public function copy(): CollectionInterface
    {
        return $this->make($this->getArrayCopy());
    }

    /**
     * Alias for copy.
     *
     * @return Collection A shallow copy of the collection.
     */
    public function clone(): CollectionInterface
    {
        return $this->copy();
    }

    /**
     * Returns whether the collection is empty.
     *
     * @return bool Whether the collection is empty.
     */
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * Removes all values from the collection.
     *
     * @return void
     */
    public function clear()
    {
        $this->exchangeArray([]);
    }

    /**
     * Returns the size of the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->getArrayCopy());
    }

    /**
     * Returns an array of the collection.
     *
     * @return array The items in the collection.
     */
    public function jsonSerialize(): array
    {
        return $this->getArrayCopy();
    }
}
