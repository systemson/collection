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

use Closure;

/**
 * A Map that uses a comparison function to map the keys to the values.
 */
class TreeMap extends Map
{
    protected $comparator;

    protected function findKey($slug)
    {
        $filter = $this->getComparator($slug);

        foreach ($this->getArrayCopy() as $pair) {
            if ($filter($pair->key, $slug)) {
                return $pair->key;
            }
        }

        return $slug;
    }

    public function setComparator(Closure $callback): void
    {
        $this->comparator = $callback;
    }

    public function getComparator($offset): Closure
    {
        if ($this->comparator instanceof Closure) {
            return $this->comparator;
        }

        return $this->defaultComparator();
    }

    protected function defaultComparator(): Closure
    {
        return function ($key, $offset) {
            return $key === $offset;
        };
    }

    public function offsetSet($offset, $value)
    {
        $offset = $this->findKey($offset);

        parent::offsetSet($offset, $value);
    }

    public function offsetExists($offset)
    {
        $offset = $this->findKey($offset);

        return parent::offsetExists($offset);
    }

    public function offsetUnset($offset)
    {
        $offset = $this->findKey($offset);

        return parent::offsetUnset($offset);
    }

    public function &offsetGet($offset)
    {
        $offset = $this->findKey($offset);
        $ret =& parent::offsetGet($offset);

        return $ret;
    }
}
