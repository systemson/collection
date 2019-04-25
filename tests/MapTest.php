<?php

namespace Tests;

use Amber\Config\ConfigAwareTrait;
use Amber\Collection\Map;
use Amber\Collection\TreeMap;
use Amber\Collection\CollectionAware\CollectionAwareClass;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
{
    public function testMap()
    {
        $collection = new Map();

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

        $collection->setComparator(function ($key, $slug) {
        	return strtoupper($key) === strtoupper($slug);
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
}
