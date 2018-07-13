<?php

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;

class Collection extends BaseCollection implements CollectionInterface
{
    public function __construct($items)
    {
        $this->new($items);
    }
}
