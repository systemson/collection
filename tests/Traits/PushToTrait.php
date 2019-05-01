<?php

namespace Tests\Traits;

trait PushToTrait
{
    public function testPushTo()
    {
        $collection = $this->newCollection();

        /* Test pushing strings to a key */
        $this->assertTrue($collection->pushTo('key2', 'value1'));
        $this->assertTrue($collection->pushTo('key2', 'value2'));
        $this->assertEquals(['value1', 'value2'], $collection->get('key2'));

        /* Test pushing arrays to a key */
        $this->assertTrue($collection->pushTo('key3', ['key1' => 'value1']));
        $this->assertTrue($collection->pushTo('key3', ['key2' => 'value2']));
        $this->assertEquals(['key1' => 'value1', 'key2' => 'value2'], $collection->get('key3'));
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
}