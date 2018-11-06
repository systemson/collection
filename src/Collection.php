<?php

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;

/**
 * @todo MUST throw exceptions on argument validations.
 * @todo SHOULD add support por seaching wildcars. Like: $collection->get('base.{*}.other');
 *       SHOULD return an array if many items are found, else the matching item.
 * @todo MUST allow extending classes to set custom multilevel separator. Like '/' instead of '.'
 * @todo SHOULD consider adding caching ability.
 */
class Collection extends BaseCollection
{
}
