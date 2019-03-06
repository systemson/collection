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
trait CollectionAwareTrait
{
    /**
     * @var The instance of the Collection.
     */
    protected $collection;

    /**
     * Sets the Collection instance.
     *
     * @param CacheDriver $collection An instance of the Collection.
     *
     * @return void
     */
    public function setCollection(Collection $collection): void
    {
        $this->collection = $collection;
    }

    /**
     * Gets the Collection instance.
     *
     * @return Collection The instance of the Collection.
     */
    public function getCollection(): Collection
    {
        return $this->collection;
    }

    /**
     * Creates a Collection instance.
     *
     * @param array $array The items for the collection.
     *
     * @return void
     */
    protected function initCollection(array $array = []): void
    {
        $this->collection = new Collection($array);
    }
}
