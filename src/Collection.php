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

use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;
use ArrayObject;

/**
 * Wrapper class for working with arrays.
 *
 * @todo SHOULD be renamed to Vector or ArrayObject
 */
class Collection extends ArrayObject implements CollectionInterface
{
    use BaseCollection;

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
}
