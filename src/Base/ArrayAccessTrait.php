<?php

namespace Amber\Collection\Base;

/**
 * Implements ArrayAccess.
 */
trait ArrayAccessTrait
{
    public $container;

    /**
     * Sets the value at the specified index to newval.
     *
     * @param string|int $offset
     * @param mixed $value
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Returns whether the requested index exists.
     *
     * @param string|int $offset
     *
     * @return void
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Removes the requested index.
     *
     * @param string|int $offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Returns the value for the requested index exists.
     *
     * @param string|int $offset
     *
     * @return void
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }
}
