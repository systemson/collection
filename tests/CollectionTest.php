<?php

namespace Tests;

use Amber\Config\ConfigAwareTrait;
use Amber\Collection\Collection;
use Amber\Collection\CollectionAware\CollectionAwareClass;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testCollection()
    {
        $qty = 3;

        for ($x = 1; $x <= $qty; $x++) {
            $multiple[] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];
        }

        $collection = new Collection($multiple);

        /* Test that the collection can be used as array */
        $this->assertEquals($multiple, $collection->toArray());
        $this->assertInternalType('array', $collection->toArray());
        $this->assertInstanceOf(\Traversable::class, $collection);
        $this->assertFalse($collection->isEmpty());
        $this->assertTrue($collection->isNotEmpty());
        $this->assertEquals($qty, $collection->count());

        /* Test iterator */
        foreach ($collection as $item) {
        }

        $collection[] = 'lol';
        $collection[$qty] = 'lol';

        isset($collection[$qty]);
        unset($collection[$qty]);
        $collection[$qty - 1];

        /* Test clear */
        $collection->clear();
        $this->assertEmpty($collection);

        $this->assertEquals(
            $collection->clone(),
            $collection->copy()
        );

        return $multiple;
    }

    /**
     * @depends testCollection
     */
    public function testOthers($multiple)
    {
        $collection = new Collection($multiple);

        $sorted = $collection->sort(function ($a, $b) {
            return $b <=> $a;
        });

        $this->assertEquals(
            array_reverse($multiple),
            $sorted->toArray()
        );

        $reversed = $sorted->reverse();
        $this->assertEquals(
            $multiple,
            $reversed->toArray()
        );

        $this->assertEquals(
            array_merge($multiple, $multiple, $multiple),
            $collection->merge($multiple, $multiple)->toArray()
        );

        $this->assertEquals(
            array_chunk($multiple, 2),
            $collection->chunk(2)->toArray()
        );
    }

    /**
     * @depends testCollection
     */
    public function testJson($multiple)
    {
        $collection = new Collection($multiple);

        $this->assertEquals(json_encode($multiple), json_encode($collection));
        $this->assertEquals(json_encode($multiple), $collection->toJson());

        return $collection;
    }

    /**
     * @depends testJson
     */
    public function testCollectionAware($collection)
    {
        $container = $this->getMockForAbstractClass(CollectionAwareClass::class);

        $this->assertEquals([], $container->getCollection()->all());

        $this->assertNull($container->setCollection($collection));

        $this->assertInstanceOf(Collection::class, $container->getCollection());
    }
}
