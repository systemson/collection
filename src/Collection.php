<?php

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;

/**
 * @todo MUST throw exceptions on argument validations.
 * @todo MUST add support for searching wildcars. Like: $collection->get('base.{*}.other');
 *       SHOULD return an array if many items are found, else the matching item.
 * @todo SHOULD consider adding caching support.
 * @todo NEEDS refactoring to optimize speed.
 */
class Collection extends BaseCollection implements CollectionInterface
{
    /**
     * Collection constructor
     *
     * @param array $array The items for the collection.
     */
    public function __construct(array $array = [])
    {
        parent::__construct($array);

        $this->setFlags(static::ARRAY_AS_PROPS);
    }
}
