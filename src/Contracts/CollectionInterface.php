<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU public function License
 */

namespace Amber\Collection\Contracts;

interface CollectionInterface extends
    \IteratorAggregate,
    \ArrayAccess,
    \Serializable,
    \JsonSerializable,
    \Countable
{
    /**
     * Removes all values from the collection.
     *
     * @return void
     */
    public function clear(): void;

    /**
     * Returns the size of the collection.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Returns a shallow copy of the collection.
     *
     * @return self a copy of the collection.
     */
    public function copy(): CollectionInterface;

    /**
     * Returns whether the collection is empty.
     *
     * This should be equivalent to a count of zero, but is not required.
     * Implementations should define what empty means in their own context.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Returns an array representation of the collection.
     *
     * The format of the returned array is implementation-dependent.
     * Some implementations may throw an exception if an array representation
     * could not be created.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * Replaces the collection storage with a new array.
     *
     * @return array
     */
    public function exchangeArray(array $array): void;
}
