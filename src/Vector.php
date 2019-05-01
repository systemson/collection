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

use Amber\Collection\Base\BaseCollection;
use Amber\Collection\Contracts\CollectionInterface;
use Amber\Collection\Base\GenericTrait;
use Amber\Collection\Base\EssentialTrait;
use Amber\Collection\Implementations\SerializableTrait;
use Amber\Collection\Base\ArrayObject;

/**
 * Wrapper class for working with arrays.
 */
class Vector extends Collection implements CollectionInterface
{
    use BaseCollection;

    /**
     * Removes all values from the collection.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->storage = [];
    }

    /**
     * Returns the size of the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count(array_filter($this->storage));
    }

    /**
     * Returns a shallow copy of the collection.
     *
     * @return self a copy of the collection.
     */
    public function copy(): CollectionInterface
    {
        return clone $this;
    }

    /**
     * Returns whether the collection is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->count() == 0;
    }

    /**
     * Returns an array representation of the collection.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->storage;
    }
}
