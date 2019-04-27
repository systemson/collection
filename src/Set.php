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

/**
 * A sequential collection of key-value pairs.
 */
class Set extends ArrayObject implements CollectionInterface
{
    use BaseCollection;

    protected function getIndex($offset)
    {
        return array_search($offset, $this->getArrayCopy());
    }

    public function offsetSet($offset, $value)
    {
        parent::offsetSet($this->getIndex($offset), $value);
    }

    public function offsetExists($offset)
    {
        return in_array($offset, $this->getArrayCopy());
    }

    public function offsetUnset($offset)
    {
        parent::offsetUnset($this->getIndex($offset));
    }

    public function &offsetGet($offset)
    {
        $ret =& parent::offsetGet($this->getIndex($offset)) ?? null;

        return $ret;
    }
}
