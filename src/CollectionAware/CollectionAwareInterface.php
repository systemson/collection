<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection\CollectionAware;

use Amber\Collection\Collection;

/**
 * Collection setter and getter.
 */
interface CollectionAwareInterface
{
    /**
     * Sets the Collection instance.
     *
     * @param Collection $collection An instance of a Collection.
     *
     * @return void
     */
    public function setCollection(Collection $collection): void;

    /**
     * Gets the Collection instance.
     *
     * @return array The instance of the Collection.
     */
    public function getCollection(): Collection;
}
