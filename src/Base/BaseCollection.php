<?php

namespace Amber\Collection\Base;

use Amber\Config\ConfigAwareTrait;
use Amber\Config\ConfigAwareInterface;
use Ds\Collection as CollectionInterface;

/**
 * Implements the basis for the Collection.
 */
abstract class BaseCollection extends \ArrayObject implements CollectionInterface
{
    use Essential, MultipleTrait, Statements;

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
    public function has(string $key)
    {
        $collection = $this->all();

        foreach (explode('.', $key) as $search) {
            if (!isset($collection[$search])) {
                return false;
            }

            $collection = $collection[$search];
        }

        return true;
    }

    /**
     * Whether an item is not present it the collection
     *
     * @param string $key The item's key
     *
     * @return bool
     */
    public function hasNot(string $key)
    {
        return !$this->has($key);
    }

    /**
     * Sets or updates an item in the collection.
     *
     * @param string $key The item's key
     * @param mixed  $value The item's value
     *
     * @return void
     */
    public function put(string $key, $value)
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
    public function set(string $key, $value)
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
    public function add(string $key, $value)
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
    public function insert(string $key, $value)
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
    public function update(string $key, $value)
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
    public function get(string $key)
    {
        $collection = $this->getArrayCopy();

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
     * Alias for get.
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
     * Removes and retrives an item from collection.
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
    public function delete(string $key)
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

    /**
     * Merges the collection with one or more arrays.
     *
     * @param array $array The array(s) to merge with the collection.
     *
     * @return Collection A new collection instance.
     */
    public function merge(...$array)
    {
        $content = array_unshift($array, $this->getArrayCopy());

        $return = call_user_func_array('array_merge', $content);

        return $this->make($return);
    }

    /**
     * Returns a json representation to the Collection.
     *
     * @return string Json representation to the Collection.
     */
    public function __toString()
    {
        return json_encode($this->getArrayCopy());
    }
}
