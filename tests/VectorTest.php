<?php

namespace Tests;

use Amber\Collection\Vector as Collection;
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

class VectorTest extends TestCase
{
    use
        CommonTrait,
        BasicTrait,
        MultipleTrait,
        AssociativeCollectionTrait,
        PushToTrait,
        SecuencialCollectionTrait,
        ArrayFunctionsTrait,
        StatementsTrait
    ;

    protected $collection = Collection::class;
}
