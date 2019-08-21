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
    \Countable,
    Arrayable
{
    /**
     * Creates a new collection.
     *
     * @param array|Arrayable $array The items for the new collection.
     *
     * @return CollectionInterface a new Instance of the collection.
     */
    public static function make($array = []): CollectionInterface;

    /**
     * Collection consructor.
     *
     * @param array $array The items for the new collection.
     */
    public function __construct($array = []);

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
     * Replaces the collection storage with a new array.
     *
     * @param array $array
     *
     * @return void
     */
    public function exchangeArray(array $array): void;
}
