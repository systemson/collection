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

        $collection->prepend('first');

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

        $this->assertNull($collection->append(1));
        $this->assertNull($collection->append(2));
        $this->assertNull($collection->append(3));

        $this->assertEquals(1, $collection->first());
        $this->assertEquals(3, $collection->last());
        $this->assertEquals(3, $collection->count());
    }

    public function testPrepend()
    {
        $collection = $this->newCollection();

        $this->assertNull($collection->prepend(3));
        $this->assertNull($collection->prepend(2));
        $this->assertNull($collection->prepend(1));

        $this->assertEquals(1, $collection->first());
        $this->assertEquals(3, $collection->last());
        $this->assertEquals(3, $collection->count());
    }
}
