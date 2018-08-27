<?php

namespace Amber\Collection\CollectionAware;

use Amber\Collection\Collection;
use Amber\Config\ConfigAwareTrait;

trait CollectionAwareTrait
{
    use ConfigAwareTrait;

    protected $collection;

    public function setCollection(Collection $collection): void
    {
        $this->collection = $collection;
    }

    public function getCollection(iterable $array = []): Collection
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
     * @return array The collection config vars.
     */
    protected function getCollectionConfig(): iterable
    {
        return $this->getConfig('collection') ?? [];
    }
}
