<?php

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;

/**
 * @todo MUST throw exceptions on argument validations.
 * @todo MUST allow extending classes to set custom multilevel separator. Like '/' instead of '.'
 * @todo SHOULD add support for searching wildcars. Like: $collection->get('base.{*}.other');
 *       SHOULD return an array if many items are found, else the matching item.
 * @todo SHOULD consider adding caching ability.
 */
class Collection extends BaseCollection
{
}
