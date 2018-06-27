<?php

namespace Amber\Collection\Base;

use Amber\Collection\Base\ArrayAccessTrait;
use Amber\Collection\Engine\Statements;
use Ds\Traits\GenericCollection;

abstract class BaseCollection implements \JsonSerializable, \IteratorAggregate, \ArrayAccess
{
    use GenericCollection, ArrayAccessTrait, Statements;

    public function toArray()
    {
        return (array) $this->vector;
    }

    public function jsonSerialize()
    {
        return (array) $this->vector;
    }

    public function getIterator() {
        return new ArrayIterator($this->vector);
    }
}
