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
    /**
     * @var mixed
     */
    public $key;

    /**
     * @var mixed
     */
    public $value;

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function __construct($key, $value)
    {
        $this->setKey($key);
        $this->setValue($value);
    }

    /**
     * @param mixed $key
     *
     * @return PairInterface
     */
    public function setKey($key): PairInterface
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return mixed
     */
    public function &getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $value
     *
     * @return PairInterface
     */
    public function setValue($value): PairInterface
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function &getValue()
    {
        return $this->value;
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->value = null;
    }

    /**
     * @return PairInterface
     */
    public function copy(): PairInterface
    {
        return clone $this;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return is_null($this->value);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'key' => $this->key,
            'value' => $this->value,
        ];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value ?? '';
    }
}
