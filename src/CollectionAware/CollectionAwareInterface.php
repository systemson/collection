<?php

namespace Amber\Collection\CollectionAware;

use Amber\Collection\Collection;

interface CollectionAwareInterface
{
    /**
     * Sets the Collection instance.
     *
     * @param CacheDriver $collection An instance of the Collection.
     *
     * @return void
     */
    public function setCollection(Collection $collection): void;

    /**
     * Gets the Collection instance.
     *
     * @param array $array An instance of the Collection instance.
     *
     * @return array The instance of the Collection.
     */
    public function getCollection(): Collection;
}
