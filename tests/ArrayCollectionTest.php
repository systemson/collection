<?php

namespace Tests;

use Amber\Collection\ArrayCollection as Collection;
use PHPUnit\Framework\TestCase;
use Tests\Traits\{
    BasicTrait,
    MultipleTrait,
    AssociativeCollectionTrait,
    PushToTrait,
    SecuencialCollectionTrait,
    ArrayFunctionsTrait,
    StatementsTrait,
    CommonTrait
};

class ArrayCollectionTest extends TestCase
{
    use
        CommonTrait,
        BasicTrait,
        MultipleTrait,
        AssociativeCollectionTrait,
        SecuencialCollectionTrait,
        ArrayFunctionsTrait,
        StatementsTrait
    ;

    protected $collection = Collection::class;
}
