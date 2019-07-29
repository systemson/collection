<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU Public License
 */

namespace Amber\Collection\Implementations;

/**
 * Implements Serializable interface.
 */
trait SerializableTrait
{
    public function serialize()
    {
        return serialize($this->storage);
    }

    public function unserialize($data)
    {
        $this->storage = unserialize($data);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Returns as json representation of the collection.
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray()) ?? json_encode([]);
    }

    /**
     * Returns a json representation to the Collection.
     *
     * @return string
     */
    public function toString(): string
    {
        return $this->toJson();
    }

    /**
     * Returns a json representation to the Collection.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
