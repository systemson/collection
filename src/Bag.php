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
class Bag extends Collection
{
}
