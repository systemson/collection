<?php

namespace Amber\Collection\Base;

/**
 * Implements IteratorAggregate.
 */
trait IteratorTrait
{
    /**
     * Implements IteratorAggregate.
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->container);
    }
}