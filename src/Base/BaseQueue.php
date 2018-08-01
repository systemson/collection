<?php

namespace Amber\Collection\Base;

use Ds\Queue;

abstract class BaseQueue extends Essential
{
    /**
     * Init the collection.
     *
     * @param \Iterable $items    The items for the collection.
     *
     * @return void
     */
    protected function init($items = [])
    {
        $this->container = new Queue($items);
    }

    /**
     * Returns a new instance of the collection.
     *
     * @param array The items for the collecction.
     *
     * @return Collection A new collection
     */
    public static function make($array)
    {
        return new static($array);
    }
}
