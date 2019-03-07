<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection\Base;

use Ds\Collection as CollectionInterface;

/**
 * Implements the interfaces and basic methods for the Collection.
 */
trait AliasesTrait
{
    /**
     * Alias for add().
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return bool true on success, false if the item already exists.
     */
    public function insert(string $key, $value): bool
    {
        return $this->add($key, $value);
    }

    /**
     * Alias for copy.
     *
     * @return Collection A shallow copy of the collection.
     */
    public function clone(): CollectionInterface
    {
        return $this->copy();
    }

    public function sortBy(string $column): CollectionInterface
    {
        return $this->orderBy($column);
    }
}
