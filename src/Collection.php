<?php

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;

/**
 * @todo Set default configs and setteable configs.
 * @todo Add validations.
 */
class Collection extends BaseCollection implements CollectionInterface
{
    /**
     * Instantiates the collection.
     *
     * @param \Iterable $items    The items for the collection.
     * @param bool      $sequence Whether the collection is numeric or not.
     */
    public function __construct($items, $sequence = true)
    {
        $this->isIterable($items);

        $this->init($items, $sequence);
    }
}
