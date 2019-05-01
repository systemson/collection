<?php

namespace Tests;

use Amber\Collection\CollectionCommons;
use PHPUnit\Framework\TestCase;

class CollectionCommonsTest extends TestCase
{
    private function newArray(int $n = 5, string $key = '')
    {
        for ($x = 0; $x < $n; $x++) {
            $multiple["{$key}{$x}"] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];
        }

        return $multiple;
    }

    private function newCollection(array $array = [])
    {
        return $this->getMockForAbstractClass(CollectionCommons::class, [$array]);
    }

    public function testArrayAccess()
    {
        $collection = $this->newCollection($array = $this->newArray());

        for ($x=0; $x <= count($collection); $x++) { 
            $this->assertEquals($array[$x], $collection[$x]);

            $this->assertTrue(isset($collection[$x]));

            unset($collection[$x]);

            $this->assertFalse(isset($collection[$x]));
        }
    }

    public function testPropertyAccess()
    {
        $collection = $this->newCollection($array = $this->newArray(5, 'key'));

        for ($x=0; $x < count($collection); $x++) { 
            $this->assertEquals($array["key{$x}"], $collection->{"key{$x}"});

            $this->assertTrue(isset($collection->{"key{$x}"}));

            unset($collection->{"key{$x}"});

            $this->assertFalse(isset($collection->{"key{$x}"}));
        }
    }

    public function testSerialize()
    {
        $collection = $this->newCollection($array = $this->newArray(5, 'key'));

        $serialized = serialize($collection);

        $this->assertEquals($collection, unserialize($serialized));

        $this->assertEquals(json_encode($array), json_encode($collection));
    }

    public function testBasic()
    {
        $collection = $this->newCollection($array = $this->newArray(5, 'key'));

        $this->assertEquals(5, $collection->count());

        $this->assertFalse($collection->isEmpty());

        $this->assertEquals($array, $collection->toArray());

        $this->assertEquals($collection, $collection->copy());

        $collection->clear();

        $this->assertEquals(0, $collection->count());

        $this->assertTrue($collection->isEmpty());

        $this->assertEquals([], $collection->toArray());
    }
}
