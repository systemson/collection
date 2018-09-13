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

        $collection->put('key', 'value');
        $collection->add('key1', 'value');

        $this->assertTrue($collection->has('key'));

        $this->assertEquals('value', $collection->get('key'));
        $this->assertEquals('value', $collection->find('key1'));

        $collection->remove('key');

        $this->assertFalse($collection->has('key'));

        return $collection;
    }

    public function testNumericCollection()
    {
        $collection = new Collection();

        $collection->push('value');

        $this->assertTrue($collection->has(0));

        $this->assertEquals('value', $collection->get(0));

        $collection->remove(0);

        $this->assertFalse($collection->has(0));

        return $collection;
    }
}
