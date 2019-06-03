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

/**
 * Implements basic set, get, has and unset methods.
 */
trait GenericTrait
{
    /**
     * Sets or updates an item in the collection.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return void
     */
    public function set(string $key, $value = null): void
    {
        $this->offsetSet($key, $value);
    }

    /**
     * Adds a new item to the collection.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return bool true on success, false if the item already exists.
     */
    public function add(string $key, $value): bool
    {
        if ($this->has($key)) {
            return false;
        }

        $this->set($key, $value);

        return true;
    }

    /**
     * Updates an existent item in the collection.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return bool true on success, false if the item does not exists.
     */
    public function update(string $key, $value): bool
    {
        if ($this->hasNot($key)) {
            return false;
        }

        $this->set($key, $value);

        return true;
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
        return $this->offsetExists($key);
    }

    /**
     * Whether an item is not present it the collection
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function hasNot(string $key): bool
    {
        return !$this->has($key);
    }

    /**
     * Whether an item is not present it the collection by it's value.
     *
     * @param mixed $value The item's value
     *
     * @return bool
     */
    public function contains($value): bool
    {
        return in_array($value, $this->toArray());
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
        return $this->offsetGet($key) ?? null;
    }

    /**
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return void.
     */
    public function unset(string $key): void
    {
        $this->offsetUnset($key);
    }

    /**
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return bool true on success, false on failure.
     */
    public function delete(string $key): bool
    {
        if ($this->has($key)) {
            $this->unset($key);
            return true;
        }

        return false;
    }

    /**
     * Deletes and retrives an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed|null The removed item's value, or void if the item don't exists.
     */
    public function remove(string $key)
    {
        if ($this->hasNot($key)) {
            return;
        }

        $item = $this->get($key);

        $this->unset($key);

        return $item;
    }

    /**
     * Sets or updates an array of items in the collection, and returns true on success.
     *
     * @param array $array The item's key => value pairs
     *
     * @return void
     */
    public function setMultiple(array $array): void
    {
        foreach ($array as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Gets multiple items from the collection.
     *
     * @param array $array The item's keys
     *
     * @return array
     */
    public function getMultiple(array $array): array
    {
        $return = [];

        foreach ($array as $key) {
            $return[$key] = $this->get($key);
        }

        return $return;
    }

    /**
     * Whether multiple items are present in the collection.
     *
     * @param array $array The item's keys
     *
     * @return bool
     */
    public function hasMultiple(array $array): bool
    {
        $return = [];

        foreach ($array as $key) {
            if ($this->hasNot($key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Unsets an array of items in the collection.
     *
     * @param array $array The item's key => value pairs
     *
     * @return void
     */
    public function unsetMultiple(array $array): void
    {
        foreach ($array as $key) {
            $this->unset($key);
        }
    }
}
