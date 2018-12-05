<?php

namespace Amber\Collection\CollectionAware;

use Amber\Collection\Collection;

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
     * @return void
     */
    protected function initCollection(array $array = []): void
    {
        $this->collection = new Collection($array);
    }
}
