<?php

namespace Amber\Collection\Base;

use Amber\Config\ConfigAwareTrait;
use Amber\Config\ConfigAwareInterface;
use Amber\Validator\Validator;
use Ds\Collection as CollectionInterface;

/**
 * Implements the basis for the Collection.
 *
 */
abstract class BaseCollection extends \ArrayObject implements ConfigAwareInterface, CollectionInterface
{
    use Validator, ConfigAwareTrait, Essential;

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
     * Whether an item is present it the collection
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
     * Adds a new item to the collection.
     *
     * @todo MUST validate that the item does not exist.
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
     * @todo MUST validate that the item does not exist.
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
     * Sets a new item at the end of the collection.
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
     * @return mixed The item's value.
     */
    public function find($key)
    {
        return $this[$key] ?? null;
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
     * Removes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return bool. True on success, false is the item does not exists.
     */
    public function remove($key)
    {
        if ($this->hasNot($key)) {
            return false;
        }

        unset($this[$key]);

        return true;
    }
}
