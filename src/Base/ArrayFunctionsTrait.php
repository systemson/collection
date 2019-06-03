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
use Closure;

/**
 * Implementations of the PHP array functions.
 */
trait ArrayFunctionsTrait
{
    /**
     * Returns a new sorted collection using a user-defined comparison function.
     *
     * @param Closure $callback The user-defined comparison function.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function sort(Closure $callback = null): CollectionInterface
    {
        $array = $this->toArray();

        if (is_null($callback)) {
            sort($array);
        } else {
            usort(
                $array,
                $callback
            );
        }

        return static::make($array);
    }

    /**
     * Returns a new reversed collection.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function reverse(): CollectionInterface
    {
        $array = array_reverse($this->toArray());

        return static::make($array);
    }

    /**
     * Splits an array into chunks.
     *
     * @param int  $size          The size of each chunk.
     * @param bool $preserve_keys Whether the keys should be preserved.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function chunk(int $size, bool $preserve_keys = false): CollectionInterface
    {
        $return = array_chunk($this->toArray(), $size, $preserve_keys);

        return static::make($return);
    }

    /**
     * Returns the values from a single column.
     *
     * @param string $column The column.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function column(string $column): CollectionInterface
    {
        $return = array_column($this->toArray(), $column);

        return static::make($return);
    }

    /**
     * Exchanges all keys with their associated values.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function flip(): CollectionInterface
    {
        $return = array_flip($this->toArray());

        return static::make($return);
    }

    /**
     * Returns the items that are present in the collection and the array.
     *
     * @param array $array The array(s) to compare.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function intersect(array ...$array): CollectionInterface
    {
        $return = call_user_func_array('array_intersect', array_merge([$this->toArray()], $array));

        return static::make($return);
    }

    /**
     * Returns the items that are not present in the collection and the array.
     *
     * @param array $array The array(s) to compare.
     *
     * @return CollectionInterface A new collection instance.
     */
    public function diff(array ...$array): CollectionInterface
    {
        $return = call_user_func_array('array_diff', array_merge([$this->toArray()], $array));

        return static::make($return);
    }

    /**
     * Pick one or more random items from the collection.
     *
     * @param int $num
     *
     * @return CollectionInterface
     */
    public function random(int $num = 1): CollectionInterface
    {
        if ($this->isEmpty()) {
            return static::make();
        }

        $keys = array_rand($this->toArray(), $num);

        $return = $this->getMultiple((array) $keys);

        return static::make($return);
    }

    /**
     * Returns all the unique elements of the collection.
     *
     * @param string $column The column to get the unique values.
     *
     * @return CollectionInterface
     */
    public function unique(string $column = null): CollectionInterface
    {
        $return = array_unique($this->toArray());

        return static::make($return);
    }
}
