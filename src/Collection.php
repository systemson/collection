<?php

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;
use Ds\Vector;

class Collection extends BaseCollection implements CollectionInterface
{
    public function __construct($items)
    {
        $array = [];

        foreach ($items as $item) {
            $array[] = $item;
        }

        $this->container = new Vector($array);
    }

    public static function make($array)
    {
        return new Collection($array);
    }
}
