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
     * @todo Should return type void.
     *
     * @param CacheDriver $collection An instance of the Collection.
     *
     * @return void
     */
    public function setCollection(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Gets the Collection instance.
     *
     * @param array $array An instance of the Collection instance.
     *
     * @return array The instance of the Collection.
     */
    public function getCollection(array $array = []): Collection
    {
        /* Checks if the CacheInterface is already instantiated. */
        if (!$this->collection instanceof Collection) {
            $this->collection = new Collection($array);

            $this->collection->setConfig($this->getCollectionConfig());
        }

        return $this->collection;
    }

    /**
     * Gets the collection config vars
     *
     * @todo Should return type iterable. For PHP7.1
     *
     * @return array The collection config vars.
     */
    protected function getCollectionConfig()
    {
        return $this->getConfig('collection') ?? [];
    }
}
