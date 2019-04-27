<?php

namespace Tests;

use Amber\Collection\Set as Collection;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testBasic()
    {
        $collection = new Collection();

        $ret = array_search(1, [0,2,3]);

        dump($ret ? $ret : null);

        // Sets a value
        $this->assertNull($collection->set('key', 'value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has('value'));

        // Gets the value
        $this->assertEquals('value', $collection->get('value'));
        $this->assertEquals('value', $collection->value);
        $this->assertEquals('value', $collection['value']);
        
        // Deletes the item
        $this->assertTrue($collection->delete('value'));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete('value'));
        $this->assertFalse($collection->has('value'));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get('value1'));
    }
}
