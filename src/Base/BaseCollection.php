<?php

namespace Amber\Collection\Base;

use Amber\Config\ConfigAwareTrait;
use Amber\Config\ConfigAwareInterface;

/**
 * Implements the basis for the Collection.
 */
abstract class BaseCollection extends \ArrayObject
{
    use Essential, ArrayFunctionsTrait, MultipleTrait, Statements;

    /**
     * @var string The separator for multilevel keys.
     */
    protected $separator = '.';

    /**
     * Splits a multilevel key or returns the single level key.
     *
     * @param string $key The key to split.
     *
     * @return array|string An array of keys or a single key string.
     */
    protected function splitKey(string $key)
    {
        $slug_array = explode($this->separator, $key);

        if (count($slug_array) == 1) {
            return $key;
        }

        return $slug_array;
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
        $slug = $this->splitKey($key);

        if (is_string($slug)) {
            return isset($this[$slug]);
        }

        $collection = $this->all();

        foreach ($this->splitKey($key) as $search) {
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
        $slug = $this->splitKey($key);

        if (is_string($slug)) {
            $this[$slug] = $value;
            return;
        }

        $storage = $value;

        foreach (array_reverse($slug) as $id => $key) {
            if ($id === count($slug) - 1) {
                break;
            }

            $aux[$key] = $storage;

            $storage = $aux;
            unset($aux);
        }

        $this[$key] = $storage;
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

        $this->put($key, $value);

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

        $this->put($key, $value);

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
     * Push a new item at the end of a item in the collection.
     *
     * This should be used for none associative collections.
     *
     * @todo MUST accept multilevel keys.
     *
     * @param string $key The item's key
     * @param mixed  $value The item's value
     *
     * @return bool
     */
    public function pushTo(string $key, $value)
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
    public function get(string $key)
    {
        $slug = $this->splitKey($key);

        if (is_string($slug)) {
            return $this[$slug];
        }

        $collection = $this->getArrayCopy();

        foreach ($slug as $search) {
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

        $this->delete($key);

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
        $slug = $this->splitKey($key);

        if (is_string($slug)) {
            if (isset($this[$slug])) {
                unset($this[$slug]);
                return true;
            }
            return false;
        }

        if ($this->hasNot($key)) {
            return false;
        }

        $this->set($key, null);

        return true;
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
