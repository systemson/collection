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

use Amber\Collection\Contracts\CollectionInterface;

/**
 * Implements basic methods for the Collection.
 */
trait EssentialTrait
{
    /**
     * Creates a new collection.
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
     * Alias for toArray().
     *
     * @return array The items in the collection.
     */
    public function all(): array
    {
        return $this->toArray();
    }

    /**
     * Retuns an array of the collection keys.
     *
     * @return array The items in the collection.
     */
    public function keys(): array
    {
        return array_keys($this->toArray());
    }

    /**
     * Retuns an array of the collection values.
     *
     * @return array The items in the collection.
     */
    public function values(): array
    {
        return array_values($this->toArray());
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
     * Joins the collection items into a string.
     *
     * @param string $glue The glue string between each element.
     *
     * @return string
     */
    public function implode(string $glue = ', '): string
    {
        return implode($glue, $this->toArray());
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
        return max($this->toArray());
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
        return min($this->toArray());
    }

    /**
     * Returns a json representation to the Collection.
     *
     * @return string Json representation to the Collection.
     */
    public function __toString()
    {
        return json_encode($this->toArray());
    }
}
