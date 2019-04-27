<?php

namespace Tests;

use Amber\Collection\MultilevelCollection as Collection;
use PHPUnit\Framework\TestCase;

class MultilevelCollectionTest extends TestCase
{
    public function testMultiLevelCollection()
    {
        $first = 'first';
        $second = 'second';
        $third = 'third';

        $slug = "{$first}.{$second}.{$third}";
        $value = 'value';

        $collection = new Collection();

        $this->assertNull($collection->put($slug, $value));

        $this->assertTrue($collection->has("$first"));
        $this->assertTrue($collection->has("{$first}.{$second}"));
        $this->assertTrue($collection->has("{$first}.{$second}.{$third}"));

        $this->assertEquals($value, $collection->get("{$first}.{$second}.{$third}"));
        $this->assertEquals([$third => $value], $collection->get("{$first}.{$second}"));
        $this->assertEquals([$second => [$third => $value]], $collection->get("{$first}"));

        $this->assertTrue($collection->delete("{$first}.{$second}.{$third}"));
        $this->assertFalse($collection->delete("{$first}.{$second}.{$third}"));
        $this->assertFalse($collection->has("{$first}.{$second}.{$third}"));
        $this->assertNull($collection->get("{$first}.{$second}.{$third}"));

        $this->assertTrue($collection->delete("{$first}.{$second}"));
        $this->assertFalse($collection->delete("{$first}.{$second}"));
        $this->assertFalse($collection->has("{$first}.{$second}"));
        $this->assertNull($collection->get("{$first}.{$second}"));

        $this->assertTrue($collection->delete("{$first}"));
        $this->assertFalse($collection->delete("{$first}"));
        $this->assertFalse($collection->has("{$first}"));
        $this->assertNull($collection->get("{$first}"));

        //$collection->clear();

        $this->assertNull($collection->put($slug, $value));

        $this->assertEquals($value, $collection->remove("{$first}.{$second}.{$third}"));
        $this->assertFalse($collection->has("{$first}.{$second}.{$third}"));

        $this->assertEquals([$third => null], $collection->remove("{$first}.{$second}"));
        $this->assertFalse($collection->has("{$first}.{$second}"));

        $this->assertEquals([$second => null], $collection->remove("{$first}"));
        $this->assertFalse($collection->has("$first"));

        $this->assertNull($collection->put("$first", $value));
        $this->assertEquals($value, $collection->get("$first", $value));
    }

    public function testSimpleCollection()
    {
        $collection = new Collection([], false);

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
