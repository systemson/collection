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
trait SecuentialCollectionTrait
{
    /**
     * Returns a new collection with the item appended.
     *
     * This should be used for none associative collections.
     *
     * @param mixed $value The item's value
     *
     * @return CollectionInterface
     */
    public function append($value): CollectionInterface
    {
        $new = $this->clone();

        $new->offsetSet(null, $value);

        return $new;
    }

    /**
     * Returns a new collection with the item prepended.
     *
     * This should be used for none associative collections.
     *
     * @param mixed $value The item's value
     *
     * @return CollectionInterface
     */
    public function prepend($value): CollectionInterface
    {
        $new = $this->clone();

        $array = array_merge([$value], $this->toArray());

        $new->exchangeArray($array);

        return $new;
    }
}
