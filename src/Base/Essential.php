<?php

namespace Amber\Collection\Base;

use Amber\Collection\Collection;
use Ds\Collection as CollectionInterface;

/**
 * Implements the basis for the Collection.
 */
trait Essential
{
    /**
     * Returns a new collection.
     *
     * @param array $array The items for the new collection.
     *
     * @return static a new Instance of the collection.
     */
    protected function make($array = [])
    {
        return new static($array);
    }

    /**
     * Returns an array of the collection.
     *
     * @return array The items in the collection.
     */
    public function toArray(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * Returns an json representation of the collection.
     *
     * @return string The json representation of the collection.
     */
    public function toJson(): string
    {
        return json_encode($this->getArrayCopy());
    }

    /**
     * Alias for toArray().
     *
     * @return array The items in the collection.
     */
    public function all(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * Retuns an array of the collection keys.
     *
     * @return array The items in the collection.
     */
    public function keys(): array
    {
        return array_keys($this->getArrayCopy());
    }

    /**
     * Retuns an array of the collection values.
     *
     * @return array The items in the collection.
     */
    public function values(): array
    {
        return array_values($this->getArrayCopy());
    }

    /**
     * Creates a shallow copy of the collection.
     *
     * @return Collection a shallow copy of the collection.
     */
    public function copy(): CollectionInterface
    {
        return $this->make($this->getArrayCopy());
    }

    /**
     * Alias for copy.
     *
     * @return Collection A shallow copy of the collection.
     */
    public function clone(): CollectionInterface
    {
        return $this->copy();
    }

    /**
     * Returns whether the collection is empty.
     *
     * @return bool Whether the collection is empty.
     */
    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }

    /**
     * Returns the size of the collection.
     *
     * @return int
     */
    public function count(): int
    {
        return count(array_filter($this->getArrayCopy()));
    }

    /**
     * Removes all values from the collection.
     *
     * @return void
     */
    public function clear()
    {
        $this->exchangeArray([]);
    }

    /**
     * Returns an array of the collection.
     *
     * @return array The items in the collection.
     */
    public function jsonSerialize(): array
    {
        return $this->getArrayCopy();
    }

    /**
     * Iterates through the collection and passes each value to the given callback.
     *
     * @return Collection A new collection instance.
     */
    public function map($callback): CollectionInterface
    {
        $array = array_map(
            $callback,
            $this->getArrayCopy()
        );

        return $this->make($array);
    }

    /**
     * Filters the elements of the collection using a user-defined function.
     *
     * @return static.
     */
    public function filter($callback): self
    {
        $array = array_filter(
            $this->getArrayCopy(),
            $callback
        );

        $this->exchangeArray($array);

        return $this;
    }

    /**
     * Returns a new filtered collection using a user-defined function.
     *
     * @return Collection A new collection instance.
     */
    public function filtered($callback): Collection
    {
        $array = array_filter(
            $this->getArrayCopy(),
            $callback
        );

        return $this->make(array_values($array));
    }

    /**
     * Sorts the elements of the collection using a user-defined comparison function.
     *
     * @param callable $callback The user-defined comparison function.
     *
     * @return static
     */
    public function sort($callback): self
    {
        $array = $this->getArrayCopy();

        usort(
            $array,
            $callback
        );

        $this->exchangeArray($array);

        return $this;
    }

    /**
     * Returns a new sorted collection using a user-defined comparison function.
     *
     * @param callable $callback The user-defined comparison function.
     *
     * @return Collection A new collection instance.
     */
    public function sorted($callback): CollectionInterface
    {
        $array = $this->getArrayCopy();

        usort(
            $array,
            $callback
        );

        return $this->make($array);
    }

    /**
     * Reverses the order of the collection.
     *
     * @return static
     */
    public function reverse(): self
    {
        $array = array_reverse($this->getArrayCopy());

        $this->exchangeArray($array);

        return $this;
    }

    /**
     * Returns a new reversed collection.
     *
     * @return Collection A new collection instance.
     */
    public function reversed(): CollectionInterface
    {
        $array = array_reverse($this->getArrayCopy());

        return $this->make($array);
    }

    /**
     * Merges the collection with one or more arrays.
     *
     * @param array $array The array(s) to merge with the collection.
     *
     * @return static
     */
    public function merge(...$array): self
    {
        $content = array_unshift($array, $this->getArrayCopy());

        $return = call_user_func_array('array_merge', $content);

        $this->exchangeArray($return);

        return $this;
    }

    /**
     * Returns a new collection merged with one or more arrays.
     *
     * @param array $array The array(s) to merge with the collection.
     *
     * @return Collection A new collection instance.
     */
    public function merged(...$array): Collection
    {
        $content = array_unshift($array, $this->getArrayCopy());

        $return = call_user_func_array('array_merge', $content);

        return $this->make($return);
    }
}
