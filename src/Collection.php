<?php

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;
use Ds\Vector;

class Collection extends BaseCollection
{
    public function __construct($items)
    {
        $array = [];

        foreach ($items as $item) {
            $array[] = $item;
        }

        $this->container = new Vector($array);
    }
}
