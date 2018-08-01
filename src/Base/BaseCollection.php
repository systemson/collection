<?php

namespace Amber\Collection\Base;

use Amber\Collection\Collection;
use Amber\Config\ConfigAware;
use Amber\Config\ConfigAwareInterface;
use Amber\Validator\Validator;
use Ds\Collection as CollectionInterface;
use Ds\Map;
use Ds\Traits\GenericCollection;
use Ds\Vector;

/**
 * Implements the basis for the Collection.
 *
 * @todo Implement JsonSerializable interface.
 */
abstract class BaseCollection extends Essential
{
    use Statements;

    /**
     * Init the collection.
     *
     * @todo Should be moved to it's own trait.
     *
     * @param array The items for the collecction.
     *
     * @return void
     */
    protected function init($array = [], $sequence = true)
    {
        if ($sequence) {
            $this->container = $this->newSequence($array);
        } else {
            $this->container = $this->newAssociative($array);
        }

        $this->is_sequence = $sequence;
    }

    /**
     * Init the collection.
     *
     * @todo Should be moved to it's own trait.
     *
     * @param array The items for the collecction.
     *
     * @return Collection A new collection
     */
    protected function newSequence($array = [])
    {
        $result = [];

        foreach ($array as $value) {
            $result[] = $value;
        }

        return new Vector($result);
    }

    /**
     * Init the collection.
     *
     * @todo Should be moved to it's own trait.
     *
     * @param array The items for the collecction.
     *
     * @return Collection A new collection
     */
    protected function newAssociative($array = [])
    {
        $result = [];

        foreach ($array as $key => $value) {
            $result[$key] = $value;
        }

        return new Map($result);
    }

    /**
     * Returns a new instanace of the collection.
     *
     * @param array The items for the collecction.
     *
     * @return Collection A new collection
     */
    public static function make($array)
    {
        return new static($array);
    }
}
