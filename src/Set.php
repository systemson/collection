<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection;

use Amber\Collection\Contracts\SetInterface;
use Amber\Collection\Contracts\CollectionInterface;
use Amber\Collection\Base\NoKeysTrait;
use Amber\Collection\Base\EssentialTrait;
use Amber\Collection\Base\AliasesTrait;
use Amber\Collection\Base\BaseCollection;

/**
 * A sequential collection of key-value pairs.
 */
class Set extends CollectionCommons implements SetInterface
{
    use EssentialTrait, NoKeysTrait, BaseCollection;

    /**
     * Collection consructor.
     *
     * @param array $array The items for the new collection.
     */
    public function __construct(array $array = [])
    {
        $this->storage = array_values($array);
    }

    protected function getIndex($offset)
    {
        $search = array_search($offset, $this->toArray());
        if (is_int($search)) {
            return $search;
        }

        return null;
    }

    public function offsetSet($offset, $value)
    {
        parent::offsetSet($this->getIndex($offset), $value);
    }

    public function offsetExists($offset)
    {
        return in_array($offset, $this->toArray());
    }

    public function offsetUnset($offset)
    {
        parent::offsetUnset($this->getIndex($offset));
    }

    public function &offsetGet($offset)
    {
        $ret =& parent::offsetGet($this->getIndex($offset)) ?? null;

        return $ret;
    }

    /**
     * Returns a new Collection grouped by the specified column.
     *
     * @todo MUST throw exception if the column does not exists
     *
     * @param string $column The column to group by.
     *
     * @return Collection A new collection instance.
     */
    public function groupBy(string $column): CollectionInterface
    {
        $return = [];

        foreach ($this->toArray() as $item) {
            if (isset($item[$column])) {
                $key = $item[$column];
                $return[$key] = $item;
            }
            // Must throw exception if item column does not exists
        }

        return new Collection($return);
    }
}
