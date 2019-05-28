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
 * Adds sql like methods to the collection.
 */
trait StatementsTrait
{
    /**
     * Returns a new Collection containing the items in the specified column(s).
     *
     * @param array|string $columns The columns to filter by.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function select(...$columns): CollectionInterface
    {
        return $this->map(
            function ($item) use ($columns) {
                $result = [];

                foreach ($columns as $column) {
                    if (isset($item[$column])) {
                        $result[$column] = $item[$column];
                    }
                }

                return $result;
            }
        );
    }

    /**
     * Returns a new Collection containing the items in the specified column that are equal to the especified value.
     *
     * @param string $column The columns to filter by.
     * @param mixed  $value  The value to compare each item.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function where(string $column, $value): CollectionInterface
    {
        return $this->filter(
            function ($item) use ($column, $value) {
                if (isset($item[$column])) {
                    return $item[$column] === $value;
                }
            }
        );
    }

    /**
     * Returns a new Collection containing the items in the specified column that are not equal to the especified value.
     *
     * @param string $column The columns to filter by.
     * @param mixed  $value  The value to compare each item.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function whereNot(string $column, $value): CollectionInterface
    {
        return $this->filter(
            function ($item) use ($column, $value) {
                if (isset($item[$column])) {
                    return $item[$column] !== $value;
                }
            }
        );
    }

    /**
     * Returns a new Collection containing the items in the specified column that are equal to the especified value(s).
     *
     * @param string $column The columns to filter by.
     * @param array  $values The values to compare each item.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function whereIn(string $column, array $values = []): CollectionInterface
    {
        return $this->filter(
            function ($item) use ($column, $values) {
                if (isset($item[$column])) {
                    return in_array($item[$column], $values);
                }
            }
        );
    }

    /**
     * Returns a new Collection containing the items in the specified column that are not equal
     * to the especified value(s).
     *
     * @param string $column The columns to filter by.
     * @param array  $values The values to compare each item.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function whereNotIn(string $column, array $values = []): CollectionInterface
    {
        return $this->filter(
            function ($item) use ($column, $values) {
                if (isset($item[$column])) {
                    return !in_array($item[$column], $values);
                }
            }
        );
    }

    /**
     * Returns a new Collection containing the items ordered by the especified column.
     *
     * @todo MUST throw exception if the column does not exists
     *
     * @param string $column The column to order by.
     * @param string $order  The order to sort the items.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function orderBy(string $column, string $order = 'ASC'): CollectionInterface
    {
        return $this->sort(
            function ($a, $b) use ($column, $order) {
                if (strtoupper($order) == 'ASC') {
                    return $a[$column] <=> $b[$column];
                } elseif (strtoupper($order) == 'DESC') {
                    return $b[$column] <=> $a[$column];
                }
                // Must throw exception if item column does not exists
            }
        );
    }

    /**
     * Returns a new Collection grouped by the specified column.
     *
     * @todo MUST throw exception if the column does not exists
     *
     * @param string $column The column to group by.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function groupBy(string $column): CollectionInterface
    {
        $return = [];

        foreach ($this->toArray() as $item) {
            if (isset($item[$column])) {
                $key = $item[$column];
                $return[$key] = $item;
            }
            // Must throw exception if item column does not exists
        }

        return $this->make($return);
    }

    /**
     * Returns a new Collection joined by the specified column.
     *
     * @param array  $array The array to merge
     * @param string $pkey  The key to compare on the current collection.
     * @param string $fkey  The key to compare on the provided array.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function join(array $array, string $pkey, string $fkey): CollectionInterface
    {
        return $this->map(
            function ($item) use ($array, $pkey, $fkey) {
                foreach ($array as $value) {
                    if ($item[$pkey] == $value[$fkey]) {
                        return array_merge($item, $value);
                    }
                }
            }
        );
    }

    /**
     * Calculates the sum of values in the collection.
     *
     * @param string $column The column.
     *
     * @return int The collection sum.
     */
    public function sum(string $column = null): int
    {
        if (!is_null($column)) {
            return $this->column($column)->sum();
        }

        return array_sum($this->toArray());
    }
}
