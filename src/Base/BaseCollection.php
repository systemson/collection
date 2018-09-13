<?php

namespace Amber\Collection\Base;

use Amber\Config\ConfigAwareTrait;
use Amber\Config\ConfigAwareInterface;
use Amber\Validator\Validator;
use Ds\Collection as CollectionInterface;

/**
 * Implements the basis for the Collection.
 *
 * @todo MUST implement Ds/Collection interface.
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
     * Alias for put.
     *
     * @param string $key The item's key
     * @param mixed  $value The item's value
     *
     * @return void
     */
    public function add($key, $value)
    {
        $this[$key] = $value;
    }

    /**
     * Sets a new item in the collection.
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
    public function get($key)
    {
        return $this[$key];
    }

    /**
     * Alias for get.
     *
     * @param string $key The item's key
     *
     * @return mixed The item's value.
     */
    public function find($key)
    {
        return $this[$key];
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
     * Removes an item from collection.
     *
     * @param string $key The item's key
     *
     * @return void
     */
    public function remove($key)
    {
        unset($this[$key]);
    }
}
