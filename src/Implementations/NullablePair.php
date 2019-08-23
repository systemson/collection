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
 * A pair that will always return null or empty.
 */
class NullablePair extends Pair
{
    /**
     * @param mixed $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }
}
