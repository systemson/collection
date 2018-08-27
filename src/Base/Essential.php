<?php

namespace Amber\Collection\Base;

use Amber\Config\ConfigAwareInterface;
use Amber\Config\ConfigAwareTrait;
use Amber\Validator\Validator;
use Ds\Traits\GenericCollection;

/**
 * Implements the basis for the Collection.
 */
trait Essential
{
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
     * Creates a shallow copy of the collection.
     *
     * @return Collection a shallow copy of the collection.
     */
    public function copy()//: CollectionInterface
    {
        return $this->make($this->getArrayCopy());
    }

    /**
     * Alias for copy.
     *
     * @return Collection A shallow copy of the collection.
     */
    public function clone()//: CollectionInterface
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
}
