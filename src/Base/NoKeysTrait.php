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
trait NoKeysTrait
{
    /**
     * Sets or updates an item in the collection.
     *
     * @param mixed $value
     * @param mixed $new
     *
     * @return void
     */
    public function set($value, $new = null): void
    {
        $this[$value] = $new ?? $value;
    }

    /**
     * Adds a new item to the collection.
     *
     * @param mixed $value
     *
     * @return bool true on success, false if the item already exists.
     */
    public function add($value): bool
    {
        if ($this->has($value)) {
            return false;
        }

        $this->set($value);

        return true;
    }

    /**
     * Updates an existent item in the collection.
     *
     * @param mixed $old The item's key.
     * @param mixed $new The item's value.
     *
     * @return bool true on success, false if the item does not exists.
     */
    public function update($old, $new): bool
    {
        if ($this->hasNot($old)) {
            return false;
        }

        $this->set($old, $new);

        return true;
    }

    /**
     * Whether an item is present it the collection
     *
     * @param string $value The item's key
     *
     * @return bool
     */
    public function has($value): bool
    {
        return isset($this[$value]);
    }

    /**
     * Whether an item is not present it the collection
     *
     * @param mixed $key The item's key
     *
     * @return bool
     */
    public function hasNot($value): bool
    {
        return !$this->has($value);
    }

    /**
     * Alias for has().
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function contains($value): bool
    {
        return $this->has($value);
    }

    /**
     * Gets an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed|void The item's value or void if the key doesn't exists.
     */
    public function get($value)
    {
        return $this[$value] ?? null;
    }

    /**
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return void.
     */
    public function unset($value): void
    {
        if (isset($this[$value])) {
            unset($this[$value]);
        }
    }

    /**
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return bool true on success, false on failure.
     */
    public function delete($value): bool
    {
        if ($this->has($value)) {
            $this->unset($value);
            return true;
        }

        return false;
    }

    /**
     * Deletes and retrives an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed The removed item's value, or void if the item don't exists.
     */
    public function remove($value)
    {
        if ($this->hasNot($value)) {
            return;
        }

        $item = $this->get($value);

        $this->unset($value);

        return $item;
    }

    /**
     * Sets or updates an array of items in the collection, and returns true on success.
     *
     * @param array $array The item's values
     *
     * @return void
     */
    public function setMultiple(array $array): void
    {
        foreach ($array as $value) {
            $this->set($value);
        }
    }

    /**
     * Gets multiple items from the collection.
     *
     * @param array $array The item's keys
     *
     * @return mixed
     */
    public function getMultiple(array $array): array
    {
        $return = [];

        foreach ($array as $value) {
            $return[] = $this->get($value);
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

        foreach ($array as $value) {
            if ($this->hasNot($value)) {
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
        foreach ($array as $value) {
            $this->unset($value);
        }
    }
}
