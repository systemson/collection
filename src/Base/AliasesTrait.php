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

use Amber\Collection\Contracts\CollectionInterface;

/**
 * Implements the interfaces and basic methods for the Collection.
 */
trait AliasesTrait
{
    /**
     * Alias for copy().
     *
     * @return Collection A shallow copy of the collection.
     */
    public function clone(): CollectionInterface
    {
        return $this->copy();
    }

    /**
     * Alias for orderBy().
     *
     * @param string $column The column to order by.
     * @param string $order  The order to sort the items.
     *
     * @return Collection A new collection instance.
     */
    public function sortBy(string $column, string $order = 'ASC')
    {
        return $this->orderBy($column, $order);
    }
}
