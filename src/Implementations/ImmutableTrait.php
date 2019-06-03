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
 *
 */
trait ImmutableTrait
{
    public function offsetSet($offset, $value)
    {
        $this->throwImmutableException();
    }

    public function offsetUnset($offset)
    {
        $this->throwImmutableException();
    }

    protected function throwImmutableException(): RuntimeException
    {
        $class = static::class;
        throw new \RuntimeException("This collection [{$class}] is inmutable.");
    }
}
