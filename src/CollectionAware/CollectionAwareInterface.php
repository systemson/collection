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

use Amber\Collection\Contracts\CollectionInterface;

/**
 * Collection setter and getter.
 */
interface CollectionAwareInterface
{
    /**
     * Sets the Collection instance.
     *
     * @param CollectionInterface $collection An instance of a Collection.
     *
     * @return void
     */
    public function setCollection(CollectionInterface $collection): void;

    /**
     * Gets the Collection instance.
     *
     * @return CollectionInterface The instance of the Collection.
     */
    public function getCollection(): CollectionInterface;
}
