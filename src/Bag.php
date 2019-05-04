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

use Amber\Collection\Implementations\{
    IteratorAggregateTrait,
    ArrayAccessTrait,
    PropertyAccessTrait,
    SerializableTrait,
    CountableTrait
};
use Amber\Collection\Base\GenericTrait;

/**
 * Bag or multiset is an unordered collections that may contain duplicate elements.
 */
class Bag extends Set
{
    /**
     * Push a new item at the end of a item in the collection.
     *
     * @todo MUST accept multilevel keys.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return bool
     */
    public function pushTo($key, $value): bool
    {
        if (is_array($value)) {
            foreach ($value as $subKeykey => $value) {
                $this[$key][$subKeykey] = $value;
            }
        } else {
            $this[$key][] = $value;
        }

        return true;
    }
}
