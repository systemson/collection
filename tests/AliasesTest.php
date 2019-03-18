<?php

namespace Tests;

use Amber\Collection\Collection;
use PHPUnit\Framework\TestCase;

class AliasesTest extends TestCase
{
    public function testInsert()
    {
    	$collection = new Collection();

    	$this->assertTrue($collection->insert('key', 'value'));
    	$this->assertFalse($collection->insert('key', 'value'));

    	$this->assertTrue($collection->has('key'));
    	$this->assertEquals('value', $collection->get('key'));

    	$collection->clear();

    	return $collection;
    }

    /**
     * @depends testInsert
     */
    public function testClone($collection)
    {
    	$this->assertInstanceOf(Collection::class, $collection->clone());

    	$this->assertEquals(clone $collection, $collection->clone());

    	$collection->clear();

    	return $collection;
    }

    /**
     * @depends testInsert
     */
    public function testAppend($collection)
    {
    	$this->assertNull($collection->append(1));
    	$this->assertNull($collection->append(2));
    	$this->assertNull($collection->append(3));

    	$this->assertEquals(1, $collection->first());
    	$this->assertEquals(3, $collection->last());
    	$this->assertEquals(3, $collection->count());

    	$collection->clear();

    	return $collection;
    }

    public function testSortBy()
    {
        $qty = 3;

        for ($x = 1; $x <= $qty; $x++) {
            $array[] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];
        }

        $collection = new Collection($array);

        $ordered = $collection->sortBy('id', 'DESC');

        $this->assertEquals(
            array_reverse($array),
            $ordered->toArray()
        );

        $this->assertEquals(
            $array,
            $ordered->sortBy('id')->toArray()
        );
    }
}
