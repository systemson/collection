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
trait PropertyAccessTrait
{
    /**
     * @param mixed $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }

    /**
     * @param mixed $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return $this->offsetExists($name);
    }

    /**
     * @param mixed $name
     */
    public function __unset($name)
    {
        $this->offsetUnset($name);
    }

    /**
     * @param mixed $name
     *
     * @return mixed
     */
    public function &__get($name)
    {
        $ret =& $this->offsetGet($name);

        return $ret;
    }
}
