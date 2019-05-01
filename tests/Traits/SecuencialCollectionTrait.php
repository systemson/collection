<?php

namespace Tests\Traits;

trait SecuencialCollectionTrait
{
    public function testNumericCollection()
    {
        $collection = $this->newCollection();

        $collection->push('value');
            
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
}
