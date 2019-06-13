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

use Amber\Collection\Contracts\CollectionInterface;

/**
 *
 */
trait ImmutableTrait
{
    /**
     * Alias for copy().
     *
     * @return CollectionInterface A shallow copy of the collection.
     */
    public function clone(): CollectionInterface
    {
        return $this->copy();
    }

    /**
     * @throws RuntimeException
     */
    public function offsetSet($offset, $value)
    {
        throw $this->immutableException();
    }

    /**
     * @throws RuntimeException
     */
    public function offsetUnset($offset)
    {
        throw $this->immutableException();
    }

    /**
     * Replaces the collection storage with a new array.
     *
     * @param array $array
     *
     * @throws RuntimeException
     */
    public function exchangeArray(array $array): void
    {
        throw $this->immutableException();
    }

    /**
     * @throws RuntimeException
     */
    protected function immutableException(): \RuntimeException
    {
        $class = static::class;
        return new \RuntimeException("This collection [{$class}] is inmutable.");
    }
}
