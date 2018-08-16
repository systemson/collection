<?php

namespace Tests;

use Amber\Collection\Queue;
use PHPUnit\Framework\TestCase;

/*
 * @todo should be better tested
 */
class QueueTest extends TestCase
{
    public function testQueue()
    {
        $qty = 2;

        for ($x = 1; $x <= $qty; $x++) {
            $multiple[] = 'job'.$x;
        }

        $queue = new Queue($multiple);

        /* Test that the collection can be used as array */
        $this->assertEquals($multiple, $queue->toArray());
        $this->assertInternalType('array', $queue->toArray());
        $this->assertInstanceOf(\Traversable::class, $queue);
        $this->assertFalse($queue->isEmpty());
        $this->assertEquals($qty, $queue->count());

        /* Test iterator */
        foreach ($queue as $item) {
        }

        $queue[] = 'lol';

        /* Test clear */
        $queue->clear();
        $this->assertEmpty($queue);

        $this->assertEquals($queue->clone(), $queue->copy());

        return $queue;
    }
}
