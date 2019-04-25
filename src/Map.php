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

use Amber\Collection\Base\{
    ArrayObject,
    BaseCollection
};
use Ds\Collection as CollectionInterface;
use Closure;
use Amber\Collection\Implementations\Pair;

/**
 * A Collection that maps the key to the values.
 */
class Map extends ArrayObject implements CollectionInterface
{
    use BaseCollection;

    protected $comparator;

    /**
     * Sets or updates an item in the collection.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return void
     */
    public function set(string $key, $value): void
    {
        $this[$key] = $value;
    }

    /**
     * Whether an item is present it the collection
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function has(string $key): bool
    {
        return isset($this[$key]);
    }

    /**
     * Gets an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed|void The item's value or void if the key doesn't exists.
     */
    public function get(string $key)
    {
        return $this[$key] ?? null;
    }

    /**
     * Unsets an item from collection.
     *
     * @param string $key The item's key
     *
     * @return void.
     */
    public function unset(string $key): void
    {
        if (isset($this[$key])) {
            unset($this[$key]);
        }
    }

    public function offsetSet($offset, $value)
    {
        $pair = new Pair($offset, $value);

        parent::offsetSet($offset, $pair);
    }

    public function offsetExists($offset)
    {
        return parent::offsetExists($offset);
    }

    public function offsetUnset($offset)
    {
        return parent::offsetUnset($offset);
    }

    public function &offsetGet($offset)
    {
        $ret =& parent::offsetGet($offset)->value ?? null;

        return $ret;
    }
}
