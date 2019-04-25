<?php

namespace Tests;

use Amber\Collection\Base\ArrayObject;
use PHPUnit\Framework\TestCase;

class ArrayObjectTest extends TestCase
{
    public function testAsArrayNumeric()
    {
        $collection = new ArrayObject();

        // Sets a value
        $collection[] = 'value';

        // Checks that the value is set in the collection
        isset($collection[0]);

        // Gets the value
        $this->assertEquals('value', $collection[0]);
        
        // Deletes the item
        unset($collection[0]);

        // Checks that the item is not present in the collection
        $this->assertFalse(isset($collection[0]));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection[0]);
    }

    public function testAsArrayAssociative()
    {
        $collection = new ArrayObject();

        // Sets a value
        $collection['key'] = 'value';

        // Checks that the value is set in the collection
        isset($collection['key']);

        // Gets the value
        $this->assertEquals('value', $collection['key']);
        
        // Deletes the item
        unset($collection['key']);

        // Checks that the item is not present in the collection
        $this->assertFalse(isset($collection['key']));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection['key']);
    }

    public function testAsProperty()
    {
        $collection = new ArrayObject();

        // Sets a value
        $collection->key = 'value';

        // Checks that the value is set in the collection
        isset($collection->key);

        // Gets the value
        $this->assertEquals('value', $collection->key);
        
        // Deletes the item
        unset($collection->key);

        // Checks that the item is not present in the collection
        $this->assertFalse(isset($collection->key));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->key);
    }

    public function testOthers()
    {
    	$array = [1,2,3,4,5];

        $collection = new ArrayObject([1,2,3,4,5]);

		$x = 1;
        foreach ($collection as $key => $value) {
        	$this->assertEquals($x, $value);
        	$x++;
        }

        $serialized = serialize($collection);

        $this->assertEquals($collection, unserialize($serialized));
        $this->assertEquals(5, $collection->count());
        $this->assertEquals($array, $collection->getArrayCopy());
        $this->assertNull($collection->exchangeArray([]));
        $this->assertEquals(0, $collection->count());
    }
}