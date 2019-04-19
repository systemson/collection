<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection\Base;

use Ds\Collection as CollectionInterface;

/**
 * Implements the interfaces and basic methods for the Collection.
 */
trait EssentialTrait
{
    /**
     * Returns a new collection.
     *
     * @param array $array The items for the new collection.
     *
     * @return CollectionInterface a new Instance of the collection.
     */
    public static function make(array $array = []): CollectionInterface
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
     * Alias for toArray().
     *
     * @return array The items in the collection.
     */
    public function all(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * Retuns an array of the collection keys.
     *
     * @return array The items in the collection.
     */
    public function keys(): array
    {
        return array_keys($this->getArrayCopy());
    }

    /**
     * Retuns an array of the collection values.
     *
     * @return array The items in the collection.
     */
    public function values(): array
    {
        return array_values($this->getArrayCopy());
    }

    /**
     * Creates a shallow copy of the collection.
     *
     * @return Collection a shallow copy of the collection.
     */
    public function copy(): CollectionInterface
    {
        return static::make($this->getArrayCopy());
    }

    /**
     * Returns the size of the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count(array_filter($this->getArrayCopy()));
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
     * Returns whether the collection is not empty.
     *
     * @return bool Whether the collection is empty.
     */
    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
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
     * Returns an array of the collection.
     *
     * @return array The items in the collection.
     */
    public function jsonSerialize(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * Returns a json representation to the Collection.
     *
     * @return string Json representation to the Collection.
     */
    public function __toString()
    {
        return json_encode($this->getArrayCopy());
    }

    /**
     * Removes all values from the collection.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->exchangeArray([]);
    }

    /**
     * Joins the collection items into a string.
     *
     * @param string $glue The glue string between each element.
     *
     * @return string
     */
    public function implode(string $glue = ', '): string
    {
        return implode($glue, $this->getArrayCopy());
    }

    /**
     * Returns the max value of the collection.
     *
     * @param string $column The column to get the max value.
     *
     * @return string
     */
    public function max(string $column = null)
    {
        return max($this->getArrayCopy());
    }

    /**
     * Returns the min value of the collection.
     *
     * @param string $column The column to get the min value.
     *
     * @return string
     */
    public function min(string $column = null)
    {
        return min($this->getArrayCopy());
    }
}
