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
 * Implements the multiple functions.
 */
trait MultipleTrait
{

    /**
     * Sets or updates an array of items in the collection, and returns true on success.
     *
     * @param array $array The item's key => value pairs
     *
     * @return void
     */
    public function setMultiple(array $array): void
    {
        foreach ($array as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * Gets multiple items from the collection.
     *
     * @param array $array The item's keys
     *
     * @return mixed
     */
    public function getMultiple(array $array)
    {
        $return = [];

        foreach ($array as $key) {
            $return[$key] = $this->get($key);
        }

        return $return;
    }

    /**
     * Whether multiple items are present in the collection.
     *
     * @param array $array The item's keys
     *
     * @return bool
     */
    public function hasMultiple(array $array)
    {
        $return = [];

        foreach ($array as $key) {
            if ($this->hasNot($key)) {
                return false;
            }
        }

        return true;
    }
}
