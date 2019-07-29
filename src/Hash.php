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
use Amber\Collection\Base\MixedKeysTrait;
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
class Hash extends CollectionCommons implements CollectionInterface
{
    use EssentialTrait, MixedKeysTrait, BaseCollection;

    /**
     * Collection constructor.
     *
     * @param array $array The items for the new collection.
     */
    public function __construct(array $array = [])
    {
        $this->setMultiple($array);
    }

    protected function hashKey($key)
    {
        if (is_object($key)) {
            return \spl_object_hash($key);
        }

        return hash('sha1', $key);
    }

    protected function getPair($offset): PairInterface
    {
        return parent::offsetGet($this->hashKey($offset)) ?? new NullablePair($offset);
    }

    public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            $pair = $this->getPair($offset);
            $pair->setValue($value);
        } else {
            parent::offsetSet($this->hashKey($offset), new Pair($offset, $value));
        }
    }

    public function offsetExists($offset)
    {
        return !$this->getPair($offset)->isEmpty();
    }

    public function offsetUnset($offset)
    {
        $this->getPair($offset)->clear();
    }

    public function &offsetGet($offset)
    {
        $ret =& $this->getPair($offset)->getValue();

        return $ret;
    }

    public function toArray(): array
    {
        $ret = [];

        foreach (parent::toArray() as $item) {
            $ret[$item->getKey()] = $item->getValue();
        }

        return $ret;
    }
}
