<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU public function License
 */

namespace Amber\Collection\Base;

use IteratorAggregate;
use ArrayAccess;
use Serializable;
use Countable;
use Amber\Collection\Implementations\{
    IteratorAggregateTrait,
    ArrayAccessTrait,
    PropertyAccessTrait,
    SerializableTrait,
    CountableTrait
};

class ArrayObject implements IteratorAggregate, ArrayAccess, Serializable, Countable
{
    use IteratorAggregateTrait, ArrayAccessTrait, PropertyAccessTrait, SerializableTrait, CountableTrait, GenericTrait;

    protected $storage = [];

    public function __construct(array $array = [])
    {
        $this->setMultiple($array);
    }

    public function exchangeArray(array $array): void
    {
        $this->storage = [];
        $this->setMultiple($array);
    }

    public function getArrayCopy(): array
    {
        return $this->storage;
    }

    public function toArray(): array
    {
        return $this->getArrayCopy();
    }
}
