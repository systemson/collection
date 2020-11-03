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
    /**
     * Serialize the collection.
     *
     * @return string
     */
    public function serialize(): string
    {
        return serialize($this->storage);
    }

    /**
     * Unserialize the collection.
     *
     * @param array data
     *
     * @return void
     */
    public function unserialize($data): void
    {
        $this->storage = unserialize($data);
    }

    /**
     * Returns as json representation of the collection.
     *
     * @return array
     */
    public function jsonSerialize(): array
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
