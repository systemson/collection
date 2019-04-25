<?php

namespace Amber\Collection\Contracts;

use JsonSerializable;

interface PairInterface extends JsonSerializable
{
    public function clear(): void;

    public function copy(): PairInterface;

    public function isEmpty(): bool;

    public function toArray(): array;
}
