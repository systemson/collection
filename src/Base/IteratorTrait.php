<?php

namespace Amber\Collection\Base;

trait IteratorTrait
{
    /**
     * Implements IteratorAggregate.
     */
    public function getIterator() {
        return new \ArrayIterator($this->container);
    }
}