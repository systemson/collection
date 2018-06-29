<?php

namespace Amber\Collection\Base;

use Amber\Collection\Collection;
use Ds\Collection as CollectionInterface;
use Ds\Traits\GenericCollection;

abstract class BaseCollection implements \JsonSerializable, \IteratorAggregate, \ArrayAccess
{
    use GenericCollection, ArrayAccessTrait, IteratorTrait, Statements;

    /**
     * Returns an array of the collection.
     *
     * @return array The items in the collection.
     */
    public function toArray(): array
    {
        return $this->container->toArray();
    }

    /**
     * Creates a shallow copy of the collection.
     *
     * @return Collection a shallow copy of the collection.
     */
    public function copy(): CollectionInterface
    {
        return new Collection($this->container);
    }

    /**
     * Returns a copy of the current collection.
     *
     * @return object An instance of Amber\Collection\Collection.
     */
    public function clone(): CollectionInterface
    {
        return $this->copy();
    }

    /**
     * Returns whether the collection is empty.
     *
     * @return bool whether the collection is empty.
     */
    public function isEmpty(): bool
    {
        return $this->container->isEmpty() === 0;
    }

    /**
     * Removes all values from the collection.
     *
     * @return void
     */
    public function clear()
    {
        $this->container->clear();
    }

    /**
     * Returns the size of the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return $this->container->count();
    }
}
