<?php

namespace Amber\Collection\Base;

use Amber\Config\ConfigAwareTrait;
use Amber\Config\ConfigAwareInterface;
use Amber\Validator\Validator;
use Ds\Collection as CollectionInterface;

/**
 * Implements the basis for the Collection.
 */
abstract class BaseCollection extends \ArrayObject implements ConfigAwareInterface, CollectionInterface
{
    use Validator, ConfigAwareTrait, Essential, Statements;

    /**
     * Collection constructor
     *
     * @param array $array The items for the collection.
     */
    public function __construct($array = [])
    {
        parent::__construct($array);

        $this->setFlags(static::ARRAY_AS_PROPS);
    }

    /**
     * Whether an item is present it the collection
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function has($key)
    {
        return isset($this[$key]);
    }

    /**
     * Whether an item is not present it the collection
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function hasNot($key)
    {
        return !isset($this[$key]);
    }

    /**
     * Sets or updates an item in the collection.
     *
     * @param string $key The item's key
     * @param mixed  $value The item's value
     *
     * @return void
     */
    public function put($key, $value)
    {
        $this[$key] = $value;
    }

    /**
     * Sets or updates an item in the collection, and returns true on success.
     *
     * @param string $key The item's key
     * @param mixed  $value The item's value
     *
     * @return bool true
     */
    public function set($key, $value)
    {
        $this->put($key, $value);

        return true;
    }

    /**
     * Sets a new item to the collection.
     *
     * @param string $key The item's key
     * @param mixed  $value The item's value
     *
     * @return bool true on success, false if the item already exists.
     */
    public function add($key, $value)
    {
        if ($this->has($key)) {
            return false;
        }

        $this[$key] = $value;

        return true;
    }

    /**
     * Alias for add().
     *
     * @param string $key The item's key
     * @param mixed  $value The item's value
     *
     * @return bool true on success, false if the item already exists.
     */
    public function insert($key, $value)
    {
        return $this->add($key, $value);
    }

    /**
     * Updates an existent item in the collection.
     *
     * @param string $key The item's key
     * @param mixed  $value The item's value
     *
     * @return bool true on success, false if the item does not exists.
     */
    public function update($key, $value)
    {
        if ($this->hasNot($key)) {
            return false;
        }

        $this[$key] = $value;

        return true;
    }

    /**
     * Sets a new item at the end of the collection.
     *
     * This should be used for none associative collections.
     *
     * @param mixed  $value The item's value
     *
     * @return void
     */
    public function push($value)
    {
        $this[] = $value;
    }

    /**
     * Gets an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed|void The item's value or void if the key doesn't exists.
     */
    public function find($key)
    {
        $collection = $this;

        foreach (explode('.', $key) as $search) {
            if (isset($collection[$search])) {
                $collection = $collection[$search];
            } else {
                return;
            }
        }

        return $collection;
    }

    /**
     * Alias for find.
     *
     * @param string $key The item's key
     *
     * @return mixed The item's value.
     */
    public function get($key)
    {
        return $this->find($key);
    }

    /**
     * Removes and retrives an item from collection.
     *
     * @param string $key The item's key
     *
     * @return mixed The removed item's value, or void if the item don't exists.
     */
    public function remove($key)
    {
        if ($this->hasNot($key)) {
            return;
        }

        $item = $this[$key];

        unset($this[$key]);

        return $item;
    }

    /**
     * Deletes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return bool true on success false on failure.
     */
    public function delete($key)
    {
        if ($this->hasNot($key)) {
            return false;
        }

        unset($this[$key]);

        return true;
    }

    /**
     * Returns the first element of the collection.
     *
     * @return mixed The item's value.
     */
    public function first()
    {
        return $this->find($this->keys()[0]);
    }

    /**
     * Returns the last element of the collection.
     *
     * @return mixed The item's value.
     */
    public function last()
    {
        return $this->find($this->keys()[$this->count() - 1]);
    }
}
