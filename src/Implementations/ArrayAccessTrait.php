<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection\Implementations;

/**
 * Implements ArrayAccess interface.
 */
trait ArrayAccessTrait
{
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->storage[] = $value;
        } else {
            $this->storage[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->storage[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->storage[$offset]);
    }

    public function &offsetGet($offset)
    {
        $ret =& $this->storage[$offset] ?? null;

        return $ret;
    }
}
