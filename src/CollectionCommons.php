<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection;

use Amber\Collection\Implementations\{
    IteratorAggregateTrait,
    ArrayAccessTrait,
    PropertyAccessTrait,
    SerializableTrait,
    CountableTrait
};
use Amber\Collection\Contracts\CollectionInterface;

/**
 * Implements the CollectionInterface contract
 *
 * @todo Secuential and Paired collections COULD extend SplFixedArray
 * @todo Asociative collections COULD extend ArrayObject
 */
abstract class CollectionCommons implements CollectionInterface
{
    use IteratorAggregateTrait, ArrayAccessTrait, PropertyAccessTrait, SerializableTrait, CountableTrait;

    /**
     * Collection consructor.
     *
     * @param array $array The items for the new collection.
     */
    public function __construct(array $array = [])
    {
        $this->storage = $array;
    }

    /**
     * Removes all values from the collection.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->storage = [];
    }

    /**
     * Returns the size of the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count(array_filter($this->storage));
    }

    /**
     * Returns a shallow copy of the collection.
     *
     * @return self a copy of the collection.
     */
    public function copy(): CollectionInterface
    {
        return clone $this;
    }

    /**
     * Returns whether the collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->count() == 0;
    }

    /**
     * Returns an array representation of the collection.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->storage;
    }

    /**
     * Replaces the collection storage with a new array.
     *
     * @return array
     */
    public function exchangeArray(array $array): void
    {
        $this->storage = $array;
    }
}
