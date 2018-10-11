<?php

namespace Amber\Collection\Base;

trait MultipleTrait
{

    /**
     * Sets or updates an array of items in the collection, and returns true on success.
     *
     * @param array $array The item's key => value pairs
     *
     * @return bool true
     */
    public function setMultiple(array $array)
    {
        foreach ($array as $key => $value) {
            $this->put($key, $value);
        }

        return true;
    }

    /**
     * Gets multiple items from the collection.
     *
     * @param array $key The item's keys
     *
     * @return mixed
     */
    public function getMultiple(array $array)
    {
        $return = [];

        foreach ($array as $key) {
            $return[] = $this->get($key);
        }

        return $return;
    }

    /**
     * Whether multiple items are present in the collection.
     *
     * @param array $key The item's keys
     *
     * @return bool
     */
    public function hasMultiple(array $array)
    {
        $return = [];

        foreach ($array as $key) {
            if ($this->hasNot($key)) {
                return false;
            }
        }

        return true;
    }
}
