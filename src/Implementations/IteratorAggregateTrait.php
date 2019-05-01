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

use ArrayIterator;

/**
 * Implements IteratorAggregate interface.
 */
trait IteratorAggregateTrait
{
    public function getIterator()
    {
        return new ArrayIterator($this->toArray());
    }
}
