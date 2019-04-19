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

use Amber\Config\ConfigAwareTrait;
use Amber\Config\ConfigAwareInterface;

/**
 * Implements the basis for the Collection.
 *
 * @todo Should return self on methods returning void.
 */
abstract class BaseCollection extends \ArrayObject
{
    use EssentialTrait, ArrayFunctionsTrait, MultipleTrait, Statements, AliasesTrait;

    /**
     * Whether an item is present it the collection
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    abstract public function has(string $key): bool;

    /**
     * Alias for has().
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function contains(string $key): bool
    {
        return $this->has($key);
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
     * Sets or updates an item in the collection.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return void
     */
    abstract public function set(string $key, $value): void;

    /**
     * Alias for set().
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return void
     */
    public function put(string $key, $value): void
    {
        $this->set($key, $value);
    }

    /**
     * Sets a new item to the collection.
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
     * Sets a new item at the end of the collection.
     *
     * This should be used for none associative collections.
     *
     * @param mixed $value The item's value
     *
     * @return void
     */
    public function push($value): void
    {
        $this[] = $value;
    }

    /**
     * Push a new item at the end of a item in the collection.
     *
     * @todo MUST accept multilevel keys.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return bool
     */
    public function pushTo(string $key, $value): bool
    {
        $this[$key][] = $value;

        return true;
    }

    /**
     * Gets an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed|void The item's value or void if the key doesn't exists.
     */
    abstract public function get(string $key);

    /**
     * Alias for get().
     *
     * @param string $key The item's key
     *
     * @return mixed The item's value.
     */
    public function find(string $key)
    {
        return $this->get($key);
    }

    /**
     * Returns the first element of the collection.
     *
     * @return mixed The item's value.
     */
    public function first()
    {
        if ($this->isNotEmpty()) {
            return $this->find($this->keys()[0]);
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
            return $this->find($this->keys()[$this->count() - 1]);
        }
    }

    /**
     * Deletes and retrives an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed The removed item's value, or void if the item don't exists.
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
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return bool true on success, false on failure.
     */
    public function delete(string $key): bool
    {
        if ($this->hasNot($key)) {
            return false;
        }

        $this->unset($key);

        return true;
    }

    /**
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return void
     */
    abstract public function unset(string $key): void;

    /**
     * Sets a new item at the start of the collection.
     *
     * This should be used for none associative collections.
     *
     * @param mixed $value The item's value
     *
     * @return void
     */
    public function prepend($value): void
    {
        $new = array_merge([$value], $this->getArrayCopy());

        $this->exchangeArray($new);
    }

    /**
     * Returns the items of the collection that match the specified array.
     *
     * @param array $values
     *
     * @return self
     */
    public function only(array $values): self
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
     * @return self
     */
    public function except(array $values): self
    {
        return $this->filter(function ($value) use ($values) {
            return !in_array($value, $values);
        });
    }
}
