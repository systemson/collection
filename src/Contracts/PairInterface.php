<?php
/**
 * This file is part of the Amber/Collection package.
 *
 * @package Amber/Collection
 * @author  Deivi Peña <systemson@gmail.com>
 * @license GPL-3.0-or-later
 * @license https://opensource.org/licenses/gpl-license GNU public function License
 */

namespace Amber\Collection\Contracts;

use JsonSerializable;

interface PairInterface extends JsonSerializable
{
    /**
     * @param mixed $key
     *
     * @return PairInterface
     */
    public function setKey($key): PairInterface;

    /**
     * @return mixed
     */
    public function &getKey();

    /**
     * @param mixed $value
     *
     * @return PairInterface
     */
    public function setValue($value): PairInterface;

    /**
     * @return mixed
     */
    public function &getValue();

    /**
     * @return void
     */
    public function clear(): void;

    /**
     * @return PairInterface
     */
    public function copy(): PairInterface;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @return array
     */
    public function toArray(): array;
}
