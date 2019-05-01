<?php

namespace Tests;

use Amber\Collection\Map as Collection;
use Amber\Collection\TreeMap;
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

class MapTest extends TestCase
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

    public function testTreeMap()
    {
        $collection = new TreeMap();

        // Sets a value
        $this->assertNull($collection->set('key', 'value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has('key'));

        // Gets the value
        $this->assertEquals('value', $collection->get('key'));
        
        // Deletes the item
        $this->assertTrue($collection->delete('key'));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete('key'));
        $this->assertFalse($collection->has('key'));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get('key1'));
    }

    public function testTreeMapInsensitiveKeys()
    {
        $collection = new TreeMap();

        $collection->setComparator(function ($key, $value, $offset) {
        	return strtoupper($key) === strtoupper($offset);
        });

        // Sets a value
        $this->assertNull($collection->set('key', 'value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has('key'));
        $this->assertTrue($collection->has('KEY'));
        $this->assertTrue($collection->has('kEy'));

        // Gets the value
        $this->assertEquals('value', $collection->get('key'));
        $this->assertEquals('value', $collection->get('KEY'));
        $this->assertEquals('value', $collection->get('kEy'));

        // Sets another value
        $this->assertNull($collection->set('key', 'new'));

        // Gets the value
        $this->assertEquals('new', $collection->get('key'));
        $this->assertEquals('new', $collection->get('KEY'));
        $this->assertEquals('new', $collection->get('kEy'));

        // Deletes the item
        $this->assertTrue($collection->delete('keY'));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete('key'));
        $this->assertFalse($collection->delete('KEY'));
        $this->assertFalse($collection->delete('kEy'));
        $this->assertFalse($collection->has('KEY'));
        $this->assertFalse($collection->has('kEy'));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get('key'));
    }

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

        $collection = Collection::make($array);

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
