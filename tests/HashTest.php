<?php

namespace Tests;

use Amber\Collection\Hash as Collection;
use PHPUnit\Framework\TestCase;
use Tests\Traits\{
    BasicTrait,
    MultipleTrait,
    AssociativeCollectionTrait,
    ArrayFunctionsTrait,
    MixedKeysTrait,
    StatementsTrait,
    CommonTrait
};

class HashTest extends TestCase
{
    use
        BasicTrait,
        MultipleTrait,
        AssociativeCollectionTrait,
        ArrayFunctionsTrait,
        MixedKeysTrait,
        StatementsTrait,
        CommonTrait
    ;

    protected $collection = Collection::class;

    public function testClone()
    {
        $collection = $this->newCollection();

    	$this->assertInstanceOf(Collection::class, $collection->clone());

    	$this->assertEquals(clone $collection, $collection->clone());
    }

    public function testEssentials()
    {
        $collection = $this->newCollection();

        $this->assertInstanceOf(Collection::class, $collection);

        $collection->set('key', 'value');

        $this->assertEquals(['key' => 'value'], $collection->toArray());
        $this->assertEquals(['key' => 'value'], $collection->all());

        $this->assertEquals(['key'], $collection->keys());

        $this->assertEquals(['value'], $collection->values());

        $this->assertNotSame($collection, $collection->copy());
        $this->assertInstanceOf(Collection::class, $collection->copy());

        $this->assertNotSame($collection, $collection->clone());
        $this->assertInstanceOf(Collection::class, $collection->clone());

        $this->assertEquals(1, $collection->count());

        $this->assertFalse($collection->isEmpty());
        $this->assertTrue($collection->isNotEmpty());

        $this->assertEquals(json_encode(['key' => 'value']), $collection->toJson());
        $this->assertEquals(json_encode(['key' => 'value']), json_encode($collection));

        $this->assertEquals(json_encode(['key' => 'value']), (string) $collection);

        $this->assertNull($collection->clear());

        $this->assertEquals([], $collection->all());
        $this->assertEquals(0, $collection->count());
        $this->assertTrue($collection->isEmpty());
        $this->assertFalse($collection->isNotEmpty());
    }

    public function testImplode()
    {
        $string = 'Hello world';
        $array = explode(' ', $string);

        $collection = $this->newCollection($array);

        $this->assertEquals($string, $collection->implode(' '));
    }

    public function testMaxMin()
    {
        $array = [0, 1, 2, 3, 5, 8, 13, 21];

        $collection = $this->newCollection($array);

        $this->assertEquals(max($array), $collection->max());
        $this->assertEquals(min($array), $collection->min());
    }
}
