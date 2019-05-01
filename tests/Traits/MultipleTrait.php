<?php

namespace Tests\Traits;


trait MultipleTrait
{
    public function testMultiple()
    {
        $array = static::newArray();
        $collection = $this->newCollection();

        $this->assertNull($collection->setMultiple($array));

        $this->assertEquals($array, $collection->getMultiple(array_keys($array)));

        $this->assertTrue($collection->hasMultiple(array_keys($array)));

        $this->assertNull($collection->unsetMultiple(array_keys($array)));

        $this->assertFalse($collection->hasMultiple(array_keys($array)));
    }
}