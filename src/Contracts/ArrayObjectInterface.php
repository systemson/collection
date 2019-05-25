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

use ArrayIterator;

/**
 * Base Object for the collections
 */
interface ArrayObjectInterface
{
    public function __construct(iterable $input, int $flags = 0, string $iterator_class = "ArrayIterator");

    public function append($value): void;

    public function asort(): void;

    public function count(): int;

    public function exchangeArray($input): array;

    public function getArrayCopy(): array;

    public function getFlags(): int;

    public function getIterator(): ArrayIterator;

    public function getIteratorClass(): string;

    public function ksort(): void;

    public function natcasesort(): void;

    public function natsort(): void;

    public function offsetExists($index): bool;

    public function offsetGet($index);

    public function offsetSet($index, $newval): void;

    public function offsetUnset($index): void;

    public function serialize(): string;

    public function setFlags(int $flags): void;

    public function setIteratorClass(string $iterator_class) : void;

    public function uasort(callable $cmp_function) : void;

    public function uksort(callable $cmp_function) : void;

    public function unserialize(string $serialized) : void;
}
