<?php

namespace Amber\Collection\Base;

/**
 * Implements IteratorAggregate.
 */
trait IteratorTrait
{
    /**
     * Implements IteratorAggregate.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->container);
    }
}
