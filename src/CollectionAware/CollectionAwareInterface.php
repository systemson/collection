<?php

namespace Amber\Collection\CollectionAware;

use Amber\Collection\Collection;
use Amber\Config\ConfigAwareInterface;

interface CollectionAwareInterface extends ConfigAwareInterface
{
    public function setCollection(Collection $collection): void;

    public function getCollection(): Collection;
}
