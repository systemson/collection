<?php

namespace Tests;

use Amber\Collection\Implementations\Pair;
use Amber\Collection\Implementations\NullablePair;
use Amber\Collection\Contracts\PairInterface;
use PHPUnit\Framework\TestCase;

class PairTest extends TestCase
{
    public function testBasic()
    {
        $pair = new Pair('key', 'value');

        // Checks that the value is set in the pair
        $this->assertTrue($pair->getKey() == 'key');
        $this->assertTrue($pair->getValue() == 'value');

        // Gets the value
        $this->assertEquals('key', $pair->getKey());
        $this->assertEquals('value', $pair->getValue());
        $this->assertEquals('value', (string) $pair);
        $this->assertFalse($pair->isEmpty());
        $this->assertEquals(['key'=>'key', 'value'=>'value'], $pair->toArray());
        
        // Deletes the value
        $this->assertNull($pair->clear());

        // Checks that the item is not present in the collection
        $this->assertNull($pair->getValue());
        $this->assertTrue(is_null($pair->getValue()));
        $this->assertFalse($pair->getvalue() == 'value');
        $this->assertTrue($pair->isEmpty());

        $this->assertEquals($pair, $pair->copy());
        $this->assertInstanceOf(PairInterface::class, $pair->copy());

        $this->assertEquals(['key'=>'key', 'value'=>null], $pair->toArray());

        $this->assertEquals(
        	json_encode(['key'=>'key', 'value'=>null]),
        	json_encode($pair)
        );
    }

    public function testNullablePair()
    {
        $pair = new NullablePair('key', 'value');
        
        // Deletes the value
        $this->assertNull($pair->clear());

        // Checks that the item is not present in the collection
        $this->assertNull($pair->getValue());
        $this->assertTrue(is_null($pair->getValue()));
        $this->assertFalse($pair->getvalue() == 'value');
        $this->assertTrue($pair->isEmpty());

        $this->assertEquals($pair, $pair->copy());
        $this->assertInstanceOf(PairInterface::class, $pair->copy());

        $this->assertEquals(['key'=>'key', 'value'=>null], $pair->toArray());

        $this->assertEquals(
            json_encode(['key'=>'key', 'value'=>null]),
            json_encode($pair)
        );
    }
}
