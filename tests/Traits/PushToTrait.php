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
}