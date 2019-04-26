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
use Amber\Collection\Implementations\Pair;
use Amber\Collection\Implementations\MixedKeysTrait;

/**
 * A sequential collection of key-value pairs.
 */
class Hash extends ArrayObject implements CollectionInterface
{
    use BaseCollection, MixedKeysTrait;

    protected function hashKey($key)
    {
        return hash('sha1', serialize($key));
    }

    public function offsetSet($offset, $value)
    {
        parent::offsetSet($this->hashKey($offset), $value);
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
        $ret =& parent::offsetGet($this->hashKey($offset)) ?? null;

        return $ret;
    }
}
