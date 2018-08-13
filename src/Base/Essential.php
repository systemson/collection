<?php

namespace Amber\Collection\Base;

use Amber\Config\ConfigAwareInterface;
use Amber\Config\ConfigAwareTrait;
use Amber\Validator\Validator;
use Ds\Collection as CollectionInterface;
use Ds\Traits\GenericCollection;

/**
 * Implements the basis for the Collection.
 */
abstract class Essential implements
    \ArrayAccess,
    \IteratorAggregate,
    \JsonSerializable,
    CollectionInterface,
    ConfigAwareInterface
{
    use Validator,
        ArrayAccessTrait,
        IteratorTrait,
        GenericCollection,
        ConfigAwareTrait;

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
        return $this->make($this->container);
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
