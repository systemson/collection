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

/**
 * Implements the interfaces and basic methods for the Collection.
 */
trait SecuentialCollectionTrait
{
    /**
     * Sets a new item at the end of the collection.
     *
     * This should be used for none associative collections.
     *
     * @param mixed $value The item's value
     *
     * @return void
     */
    public function append($value): void
    {
        $this->offsetSet(null, $value);
    }

    /**
     * Sets a new item at the start of the collection.
     *
     * This should be used for none associative collections.
     *
     * @param mixed $value The item's value
     *
     * @return void
     */
    public function prepend($value): void
    {
        $new = array_merge([$value], $this->toArray());

        $this->exchangeArray($new);
    }
}
