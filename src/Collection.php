<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection;

use Amber\Collection\Base\BaseCollection;
use Ds\Collection as CollectionInterface;

/**
 * Wrapper class for working with arrays.
 *
 * @todo MUST throw exceptions on argument validations.
 * @todo MUST add support for searching wildcars. Like: $collection->get('base.{*}.other');
 *       SHOULD return an array if many items are found, else the matching item.
 * @todo SHOULD consider adding caching support.
 * @todo NEEDS refactoring to optimize speed.
 */
class Collection extends BaseCollection implements CollectionInterface
{
    /**
     * @var string The separator for multilevel keys.
     */
    protected $separator = '.';

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

    /**
     * Splits a multilevel key or returns the single level key(s).
     *
     * @param string $key The key to split.
     *
     * @return array|string An array of keys or a single key string.
     */
    protected function splitKey(string $key)
    {
        $slug_array = explode($this->separator, $key);

        if (count($slug_array) == 1) {
            return $key;
        }

        return $slug_array;
    }
}
