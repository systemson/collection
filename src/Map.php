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

use Amber\Collection\Base\ArrayObject;
use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;
use Closure;
use Amber\Collection\Base\MixedKeysTrait;
use Amber\Collection\Implementations\Pair;
use Amber\Collection\Implementations\NullablePair;
use Amber\Collection\Contracts\PairInterface;

/**
 * A sequential collection of key-value pairs.
 *
 * @todo MUST remove all numeric array methods.
 */
class Map extends ArrayObject implements CollectionInterface
{
    use BaseCollection, MixedKeysTrait;

    protected function getPair($offset): PairInterface
    {
        foreach ($this as $index => $pair) {
            if ($pair->key == $offset) {
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
        $pair = $this->getPair($offset);

        return !is_null($pair->value);
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            $pair = $this->getPair($offset);

            parent::offsetUnset($pair->index);
        }
    }

    public function &offsetGet($offset)
    {
        $ret =& $this->getPair($offset)->value;

        return $ret;
    }

    public function toArray(): array
    {
        foreach ($this as $item) {
            $ret[$item->key] = $item->value;
        }

        return $ret ?? [];
    }

    public function push($value)
    {
        $class = get_called_class();

        throw new \Exception("Call to undefined method [{$class}::push()]");
    }

    public function pushTo($key, $value)
    {
        $class = get_called_class();

        throw new \Exception("Call to undefined method [{$class}::pushTo()]");
    }
}
