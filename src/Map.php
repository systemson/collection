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
use Amber\Collection\Implementations\GenericTrait;

/**
 * A Collection that maps the key to the values.
 */
class Map extends ArrayObject implements CollectionInterface
{
    use BaseCollection, GenericTrait;

    public function offsetSet($offset, $value)
    {
        parent::offsetSet($offset, new Pair($offset, $value));
    }

    public function offsetExists($offset)
    {
        if (!parent::offsetExists($offset)) {
            return false;
        }

        return !is_null($this->offsetGet($offset));
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) {
            parent::offsetGet($offset)->clear();
        }
    }

    public function &offsetGet($offset)
    {
        $ret =& parent::offsetGet($offset)->value ?? null;

        return $ret;
    }
}
