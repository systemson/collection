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
     * Iterates through the collection and passes each value to the given callback.
     *
     * @param \Closure $callback
     *
     * @return CollectionInterface A new collection instance.
     */
    public function map(\Closure $callback): CollectionInterface
    {
        $array = array_map(
            $callback,
            $this->toArray()
        );

        return static::make($array);
    }

    /**
     * Returns a new filtered collection using a user-defined function.
     *
     * @param \Closure $callback
     *
     * @return CollectionInterface A new collection instance.
     */
    public function filter(\Closure $callback): CollectionInterface
    {
        $array = array_filter(
            $this->toArray(),
            $callback,
            ARRAY_FILTER_USE_BOTH
        );

        return static::make(array_values($array));
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
     * @return mixed
     */
    public function max(string $column = null)
    {
        if ($this->isNotEmpty()) {
            return max($this->toArray());
        }

        return false;
    }

    /**
     * Returns the min value of the collection.
     *
     * @param string $column The column to get the min value.
     *
     * @return mixed
     */
    public function min(string $column = null)
    {
        if ($this->isNotEmpty()) {
            return min($this->toArray());
        }

        return false;
    }

    /**
     * Returns the first element of the collection.
     *
     * @return mixed The item's value.
     */
    public function first()
    {
        if ($this->isNotEmpty()) {
            return current($this->toArray());
        }
    }

    /**
     * Returns the last element of the collection.
     *
     * @return mixed The item's value.
     */
    public function last()
    {
        if ($this->isNotEmpty()) {
            $all = $this->toArray();
            return end($all);
        }
    }

    /**
     * Returns the items of the collection that match the specified array.
     *
     * @param array $values
     *
     * @return CollectionInterface
     */
    public function only(array $values): CollectionInterface
    {
        return $this->filter(function ($value) use ($values) {
            return in_array($value, $values);
        });
    }

    /**
     * Returns the items of the collections that do not match the specified array.
     *
     * @param array $values
     *
     * @return CollectionInterface
     */
    public function except(array $values): CollectionInterface
    {
        return $this->filter(function ($value) use ($values) {
            return !in_array($value, $values);
        });
    }
}
