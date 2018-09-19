<?php

namespace Tests;

use Amber\Config\ConfigAwareTrait;
use Amber\Collection\Collection;
use Amber\Collection\CollectionAware\CollectionAwareClass;
use PHPUnit\Framework\TestCase;

class BaseCollectionTest extends TestCase
{
    public function testAssociativeCollection()
    {
        $collection = new Collection();

        /* Tests keys that don't exists */
        $this->assertTrue($collection->hasNot('key'));
        $this->assertTrue($collection->hasNot('key1'));

        /* Tests updating a key that doesn't exists */
        $this->assertFalse($collection->update('key1', 'value'));

        /* Tests adding items */
        $collection->put('key', 'value');
        $this->assertTrue($collection->insert('key1', 'value'));

        /* Tests adding an item that already exists */
        $this->assertFalse($collection->insert('key1', 'value'));

        /* Tests updating an item */
        $this->assertTrue($collection->update('key1', 'value1'));

        /* Tests that items exist */
        $this->assertTrue($collection->has('key'));
        $this->assertTrue($collection->has('key1'));

        /* Tests getting items */
        $this->assertEquals('value', $collection->get('key'));
        $this->assertEquals('value1', $collection->find('key1'));
        $this->assertEquals('value', $collection->first());
        $this->assertEquals('value1', $collection->last());

        /* Tests removing an item */
        $this->assertTrue($collection->remove('key'));

        /* Tests that the item doesn't exists */
        $this->assertFalse($collection->has('key'));
        
        /* Tests removing an item that doesn't exists */
        $this->assertFalse($collection->remove('key'));

        /* Cleares the collection */
        $collection->clear();

        return $collection;
    }

    /**
     * @depends testAssociativeCollection
     */
    public function testNumericCollection($collection)
    {
        $collection->push('value');

        $this->assertTrue($collection->has(0));

        $this->assertEquals('value', $collection->get(0));

        $collection->remove(0);

        $this->assertFalse($collection->has(0));

        return $collection;
    }
}
