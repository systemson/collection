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
use Amber\Collection\Base\MixedKeysTrait;
use Amber\Collection\Implementations\Pair;
use Amber\Collection\Implementations\NullablePair;
use Amber\Collection\Contracts\PairInterface;

/**
 * A sequential collection of key-value pairs.
 *
 * @todo MUST remove all numeric array methods.
 */
class Hash extends ArrayObject implements CollectionInterface
{
    use BaseCollection, MixedKeysTrait;

    protected function hashKey($key)
    {
        return hash('sha1', serialize($key));
    }

    protected function getPair($offset): PairInterface
    {
        return parent::offsetGet($this->hashKey($offset)) ?? new NullablePair($offset);
    }

    public function offsetSet($offset, $value)
    {
        parent::offsetSet($this->hashKey($offset), new Pair($offset, $value));
    }

    public function offsetExists($offset)
    {
        return parent::offsetExists($this->hashKey($offset));
    }

    public function offsetUnset($offset)
    {
        parent::offsetUnset($this->hashKey($offset));
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
