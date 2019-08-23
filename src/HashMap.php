<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;
use Amber\Collection\Base\EssentialTrait;
use Amber\Collection\Base\MixedKeysEncapsulationTrait;
use Amber\Collection\Contracts\CollectionInterface;
use Amber\Collection\Contracts\PairInterface;
use Amber\Collection\Implementations\Pair;
use Amber\Collection\Implementations\NullablePair;

/**
 * A sequential collection of key-value pairs.
 *
 * @todo MUST remove all numeric array methods.
 * @todo MUST use spl_​object_​hash() or spl_object_id() to hash the keys.
 */
class HashMap extends Map implements CollectionInterface
{
    /**
     * @param mixed $key
     *
     * @return string
     */
    protected function hashKey($key): string
    {
        if (is_object($key)) {
            return \spl_object_hash($key);
        }

        return hash('sha1', $key);
    }

    /**
     * @param mixed $offset
     *
     * @return PairInterface
     */
    protected function getPair($offset): PairInterface
    {
        $key = $this->hashKey($offset);

        if (isset($this->storage[$key])) {
            return $this->storage[$key];
        }

        return new NullablePair($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            $pair = $this->getPair($offset);
            $pair->setValue($value);
        } else {
            $this->storage[$this->hashKey($offset)] = new Pair($offset, $value);
        }
    }
}
