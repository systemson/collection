<?php

namespace Tests;

use Amber\Config\ConfigAwareTrait;
use Amber\Collection\Collection;
use Amber\Collection\CollectionAware\CollectionAwareClass;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testCollection()
    {
        $collection = new Collection();

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
}
