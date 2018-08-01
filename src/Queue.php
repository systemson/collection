<?php

namespace Amber\Collection;

use Amber\Collection\Base\BaseQueue;

/**
 * @todo Set default configs and settable configs.
 * @todo Add validations.
 */
class Queue extends BaseQueue
{
    /**
     * Instantiates the Queue.
     *
     * @param \Iterable $items    The items for the collection.
     */
    public function __construct($items)
    {
        $this->init($items);
    }
}
