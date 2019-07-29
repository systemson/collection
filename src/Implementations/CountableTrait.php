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
 * Implements Serializable interface.
 */
trait CountableTrait
{
    /**
     * Returns the size of the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count(array_filter($this->storage));
    }
}
