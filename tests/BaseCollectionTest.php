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
        $this->assertNull($collection->put('key', 'value'));
        $this->assertTrue($collection->add('key1', 'value1'));

        /* Tests adding an item that already exists */
        /* Insert alias for put */
        $this->assertFalse($collection->add('key1', 'value'));

        /* Tests updating an item */
        $this->assertTrue($collection->update('key1', 'value1'));

        /* Tests that items exist */
        $this->assertTrue($collection->contains('key'));
        $this->assertTrue($collection->contains('key1'));

        /* Tests getting items */
        $this->assertEquals('value', $collection->get('key'));
        $this->assertEquals('value1', $collection->find('key1'));
        $this->assertEquals('value', $collection->first());
        $this->assertEquals('value1', $collection->last());

        /* Tests removing an item */
        $this->assertTrue($collection->delete('key'));
        $this->assertEquals('value1', $collection->remove('key1'));
        $this->assertNull($collection->remove('key1'));

        /* Tests that the item doesn't exists */
        $this->assertNull($collection->get('key'));
        $this->assertNull($collection->get('key1'));
        $this->assertFalse($collection->contains('key'));
        $this->assertFalse($collection->contains('key1'));
        $this->assertNull($collection->remove('key'));
        $this->assertNull($collection->remove('key1'));
        $this->assertNull($collection->first());
        $this->assertNull($collection->last());
        
        /* Tests removing an item that doesn't exists */
        $this->assertFalse($collection->delete('key'));

        /* Test pushing strings to a key */
        $this->assertTrue($collection->pushTo('key2', 'value1'));
        $this->assertTrue($collection->pushTo('key2', 'value2'));
        $this->assertEquals(['value1', 'value2'], $collection->get('key2'));

        /* Test pushing arrays to a key */
        $this->assertTrue($collection->pushTo('key3', ['key1' => 'value1']));
        $this->assertTrue($collection->pushTo('key3', ['key2' => 'value2']));
        $this->assertEquals(['key1' => 'value1', 'key2' => 'value2'], $collection->get('key3'));

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
            
        $this->assertTrue($collection->contains(0));

        $this->assertEquals('value', $collection->get(0));
        $this->assertEquals('value', $collection->first(0));
        
        $this->assertEquals(['value'], $collection->values());

        $collection->prepend('first');

        $this->assertNotEquals('value', $collection->get(0));
        $this->assertNotEquals('value', $collection->first(0));

        $this->assertEquals('first', $collection->get(0));
        $this->assertEquals('first', $collection->first(0));
        
        $this->assertEquals(['first', 'value'], $collection->values());

        $collection->remove(0);
        $collection->remove(1);

        $this->assertFalse($collection->contains(0));
        $this->assertFalse($collection->contains(1));

        /* Cleares the collection */
        $collection->clear();

        return $collection;
    }

    public function testExceptAndOnly()
    {
        $collection = new Collection();

        $collection->push('value1');
        $collection->push('value2');
        $collection->push('value3');

        $this->assertEquals(['value1', 'value2', 'value3'], $collection->all());
        $this->assertEquals(['value1', 'value3'], $collection->except(['value2'])->toArray());
        $this->assertEquals(['value1'], $collection->only(['value1'])->toArray());
    }
}
