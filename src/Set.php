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

use Amber\Collection\Base\ArrayFunctionsTrait;
use Amber\Collection\Base\StatementsTrait;
use Amber\Collection\Base\AliasesTrait;
use Amber\Collection\Contracts\SetInterface;
use Amber\Collection\Contracts\CollectionInterface;
use Amber\Collection\Base\NoKeysTrait;
use Amber\Collection\Base\EssentialTrait;
use Amber\Collection\Base\SequentialCollectionTrait;

/**
 * A sequential collection of unique values.
 */
class Set extends CollectionCommons implements SetInterface
{
    use EssentialTrait,
        NoKeysTrait,
        ArrayFunctionsTrait,
        StatementsTrait,
        AliasesTrait,
        SequentialCollectionTrait
    ;

    /**
     * Collection constructor.
     *
     * @param array $array The items for the new collection.
     */
    public function __construct($array = [])
    {
        $this->storage = array_values($this->extractArray($array));
    }

    /**
     * @param mixed $value
     *
     * @return int|null
     */
    protected function getIndex($value)
    {
        $search = array_search($value, $this->toArray(), true);
        if (is_int($search)) {
            return $search;
        }

        return null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if ($offset !== null) {
            throw new \RuntimeException("This class [" .  get_called_class() . "] doesn't accepts indexes/keys.");
        }

        $index = $this->getIndex($value);

        parent::offsetSet($index, $value);
    }

    /**
     * @param mixed $value
     */
    public function offsetExists($value)
    {
        return $this->getIndex($value) !== null;
    }

    /**
     * @param mixed $value
     */
    public function offsetUnset($value)
    {
        parent::offsetUnset($this->getIndex($value));
    }

    /**
     * @param mixed $value
     */
    public function &offsetGet($value)
    {
        $ret =& parent::offsetGet($this->getIndex($value)) ?? null;

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
