<?php

namespace Tests\Traits;

trait SecuencialCollectionTrait
{
    public function testNumericCollection()
    {
        $collection = $this->newCollection();

        $collection[] = 'value';
            
        $this->assertTrue($collection->contains(0));

        $this->assertEquals('value', $collection->get(0));
        $this->assertEquals('value', $collection->first());
        
        $this->assertEquals(['value'], $collection->values());

        $collection = $collection->prepend('first');

        $this->assertNotEquals('value', $collection->get(0));
        $this->assertNotEquals('value', $collection->first());

        $this->assertEquals('first', $collection->get(0));
        $this->assertEquals('first', $collection->first());
        
        $this->assertEquals(['first', 'value'], $collection->values());

        $collection->remove(0);
        $collection->remove(1);

        $this->assertFalse($collection->contains(0));
        $this->assertFalse($collection->contains(1));
    }

    public function testAppend()
    {
        $collection = $this->newCollection();

        $collection = $collection->append(1);
        $this->assertEquals([1], $collection->toArray());
        $collection = $collection->append(2);
        $this->assertEquals([1, 2], $collection->toArray());
        $collection = $collection->append(3);
        $this->assertEquals([1, 2, 3], $collection->toArray());

        $this->assertEquals(1, $collection->first());
        $this->assertEquals(3, $collection->last());
        $this->assertEquals(3, $collection->count());
    }

    public function testPrepend()
    {
        $collection = $this->newCollection();

        $collection = $collection->prepend(3);
        $this->assertEquals([3], $collection->toArray());
        $collection = $collection->prepend(2);
        $this->assertEquals([2, 3], $collection->toArray());
        $collection = $collection->prepend(1);
        $this->assertEquals([1, 2, 3], $collection->toArray());

        $this->assertEquals(1, $collection->first());
        $this->assertEquals(3, $collection->last());
        $this->assertEquals(3, $collection->count());
    }
}
