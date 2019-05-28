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

use Amber\Collection\Contracts\PairInterface;

/**
 * A pair is used by Amber\Collection\Map to pair keys with values.
 */
class Pair implements PairInterface
{
    protected $key;
    protected $value;

    public function __construct($key, $value)
    {
        $this->setKey($key);
        $this->setValue($value);
    }

    public function &getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function &getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function clear(): void
    {
        $this->value = null;
    }

    public function copy(): PairInterface
    {
        return clone $this;
    }

    public function isEmpty(): bool
    {
        return is_null($this->value);
    }

    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'value' => $this->value,
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function __toString()
    {
        return (string) $this->value ?? '';
    }
}
