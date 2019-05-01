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

use Amber\Collection\Contracts\PairInterface;
use Amber\Collection\Implementations\Pair;
use Amber\Collection\Implementations\NullablePair;
use Closure;

/**
 * A Map that uses a comparison function to map the keys to the values.
 */
class TreeMap extends Map
{
    protected $comparator;

    public function getPair($offset): PairInterface
    {
        $filter = $this->getComparator();

        foreach ($this->storage as $index => $pair) {
            if ($filter($pair->key, $pair->value, $offset)) {
                $pair->index = $index;
                return $pair;
            }
        }

        return new NullablePair($offset);
    }

    public function setComparator(Closure $callback): void
    {
        $this->comparator = $callback;
    }

    public function getComparator(): Closure
    {
        if ($this->comparator instanceof Closure) {
            return $this->comparator;
        }

        return $this->defaultComparator();
    }

    protected function defaultComparator(): Closure
    {
        return function ($key, $value, $offset) {
            return $key === $offset;
        };
    }
}
