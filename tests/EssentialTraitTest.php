<?php

namespace Tests;

use Amber\Config\ConfigAwareTrait;
use Amber\Collection\SimpleCollection as Collection;
use Amber\Collection\CollectionAware\CollectionAwareClass;
use PHPUnit\Framework\TestCase;

class EssentialTraitTest extends TestCase
{
    public function testEssentials()
    {
        $collection = Collection::make();

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
}
