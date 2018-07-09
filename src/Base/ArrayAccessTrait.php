<?php

namespace Amber\Collection\Base;

use Ds\Vector;

/**
 * Implements ArrayAccess.
 */
trait ArrayAccessTrait
{
    public $container;

    /**
     * @todo Should be moved to it's own trait.
     */
    protected function new($items)
    {
        $array = [];

        foreach ($items as $item) {
            $array[] = $item;
        }

        $this->container = new Vector($array);
    }

    /**
     * Sets the value at the specified index to newval.
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
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }
}
