<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;

/**
 * Wrapper class for working with arrays.
 *
 */
class SimpleCollection extends BaseCollection implements CollectionInterface
{
    /**
     * Collection constructor
     *
     * @param array $array      The items for the collection.
     * @param bool  $multilevel Defines if the array should handle multilevel keys.
     */
    public function __construct(array $array = [])
    {
        parent::__construct($array);

        $this->setFlags(static::ARRAY_AS_PROPS);
    }

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
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return bool true on success false on failure.
     */
    public function delete(string $key): bool
    {
        if (isset($this[$key])) {
            unset($this[$key]);
            return true;
        }
        return false;
    }
}
