<?php

namespace Amber\Collection\Base;

use Amber\Collection\Base\ArrayAccessTrait;
use Amber\Collection\Engine\Statements;
use Ds\Traits\GenericCollection;

abstract class BaseCollection implements \JsonSerializable, \IteratorAggregate, \ArrayAccess
{
    use GenericCollection, ArrayAccessTrait, Statements;

    /**
     * Returns an array of the collection.
     *
     * @return array The items in the collection.
     */
    public function toArray()
    {
        return $this->container->toArray();
    }

    /**
	 * Specify the data that should be serialized to JSON.
	 *
	 * @return array The data that should be serialized.
	 */
    public function jsonSerialize()
    {
        return $this->container->toArray();
    }
    /**
     * Implements IteratorAggregate.
     */
    public function getIterator() {
        return new ArrayIterator($this->container);
    }

    /**
     * Returns a copy of the current collection.
     *
     * @return object An instance of Amber\Collection\Collection.
     */
    public function clone()
    {
        return new Collection($this->container);
    }
}
