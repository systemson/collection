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
    public function setCollection(CollectionInterface $collection): void
    {
        $this->collection = $collection;
    }

    /**
     * Gets the Collection instance.
     *
     * @return Collection The instance of the Collection.
     */
    public function getCollection(): CollectionInterface
    {
        return $this->collection;
    }
}
