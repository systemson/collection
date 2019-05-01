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

use Amber\Collection\Contracts\CollectionInterface;
use Amber\Collection\Contracts\PairInterface;
use Amber\Collection\Base\BaseCollection;
use Amber\Collection\Base\MixedKeysTrait;
use Amber\Collection\Base\EssentialTrait;
use Amber\Collection\Implementations\Pair;
use Amber\Collection\Implementations\NullablePair;

/**
 * A sequential collection of key-value pairs.
 *
 * @todo MUST remove all numeric array methods.
 */
class Map extends CollectionCommons implements CollectionInterface
{
    use EssentialTrait, MixedKeysTrait, BaseCollection;

    /**
     * Collection consructor.
     *
     * @param array $array The items for the new collection.
     */
    public function __construct(array $array = [])
    {
        $this->setMultiple($array);
    }

    protected function getPair($offset): PairInterface
    {
        foreach ($this->storage as $index => $pair) {
            if ($pair->key === $offset) {
                $pair->index = $index;
                return $pair;
            }
        }

        return new NullablePair($offset);
    }

    public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset)) {
            $pair = $this->getPair($offset);
            $pair->value = $value;
        } else {
            parent::offsetSet(null, new Pair($offset, $value));
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
        $ret =& $this->getPair($offset)->value;

        return $ret;
    }

    public function toArray(): array
    {
        foreach (parent::toArray() as $item) {
            $ret[$item->key] = $item->value;
        }

        return $ret ?? [];
    }
}
