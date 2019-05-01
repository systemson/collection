<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection\Base;

/**
 * Implements the basis for the Collection.
 *
 * @todo Should return self on methods returning void.
 */
trait BaseCollection
{
    use ArrayFunctionsTrait, Statements, AliasesTrait;

    /**
     * Sets a new item at the end of the collection.
     *
     * This should be used for none associative collections.
     *
     * @param mixed $value The item's value
     *
     * @return void
     */
    public function push($value): void
    {
        $this[] = $value;
    }

    /**
     * Push a new item at the end of a item in the collection.
     *
     * @todo MUST accept multilevel keys.
     *
     * @param string $key   The item's key
     * @param mixed  $value The item's value
     *
     * @return bool
     */
    public function pushTo($key, $value): bool
    {
        if (is_array($value)) {
            foreach ($value as $subKeykey => $value) {
                $this[$key][$subKeykey] = $value;
            }
        } else {
            $this[$key][] = $value;
        }

        return true;
    }

    /**
     * Returns the first element of the collection.
     *
     * @return mixed The item's value.
     */
    public function first()
    {
        if ($this->isNotEmpty()) {
            return current($this->toArray());
        }
    }

    /**
     * Returns the last element of the collection.
     *
     * @return mixed The item's value.
     */
    public function last()
    {
        if ($this->isNotEmpty()) {
            $all = $this->toArray();
            return end($all);
        }
    }

    /**
     * Sets a new item at the start of the collection.
     *
     * This should be used for none associative collections.
     *
     * @param mixed $value The item's value
     *
     * @return void
     */
    public function prepend($value): void
    {
        $new = array_merge([$value], $this->toArray());

        $this->exchangeArray($new);
    }

    /**
     * Returns the items of the collection that match the specified array.
     *
     * @param array $values
     *
     * @return self
     */
    public function only(array $values): self
    {
        return $this->filter(function ($value) use ($values) {
            return in_array($value, $values);
        });
    }

    /**
     * Returns the items of the collections that do not match the specified array.
     *
     * @param array $values
     *
     * @return self
     */
    public function except(array $values): self
    {
        return $this->filter(function ($value) use ($values) {
            return !in_array($value, $values);
        });
    }
}
