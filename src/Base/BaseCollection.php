<?php

namespace Amber\Collection\Base;

use Amber\Collection\Collection;
use Amber\Config\ConfigAware;
use Amber\Config\ConfigAwareInterface;
use Amber\Validator\Validator;
use Ds\Collection as CollectionInterface;
use Ds\Map;
use Ds\Traits\GenericCollection;
use Ds\Vector;

/**
 * Implements the basis for the Collection.
 *
 * @todo Implement JsonSerializable interface.
 */
abstract class BaseCollection implements \JsonSerializable, \IteratorAggregate, \ArrayAccess, ConfigAwareInterface
{
    use Validator, GenericCollection, ArrayAccessTrait, IteratorTrait, Statements, ConfigAware;

    /**
     * Init the collection.
     *
     * @todo Should be moved to it's own trait.
     *
     * @param array The items for the collecction.
     *
     * @return void
     */
    protected function init($array = [], $sequence = true)
    {
        if ($sequence) {
            $this->container = $this->newSequence($array);
        } else {
            $this->container = $this->newAssociative($array);
        }

        $this->is_sequence = $sequence;
    }

    /**
     * Init the collection.
     *
     * @todo Should be moved to it's own trait.
     *
     * @param array The items for the collecction.
     *
     * @return Collection A new collection
     */
    protected function newSequence($array = [])
    {
        $result = [];

        foreach ($array as $value) {
            $result[] = $value;
        }

        return new Vector($result);
    }

    /**
     * Init the collection.
     *
     * @todo Should be moved to it's own trait.
     *
     * @param array The items for the collecction.
     *
     * @return Collection A new collection
     */
    protected function newAssociative($array = [])
    {
        $result = [];

        foreach ($array as $key => $value) {
            $result[$key] = $value;
        }

        return new Map($result);
    }

    /**
     * Returns a new instanace of the collection.
     *
     * @param array The items for the collecction.
     *
     * @return Collection A new collection
     */
    public static function make($array)
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
     * @return Collection a shallow copy of the collection.
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
