<?php

namespace Tests;

use Amber\Collection\Collection;
use PHPUnit\Framework\TestCase;

/*
 * @todo should be better tested
 */
class AssociativeCollectionTest extends TestCase
{
    public function testCollection()
    {
        $qty = 2;

        for ($x = 1; $x <= $qty; $x++) {
            $multiple[] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];
        }

        $collection = new Collection($multiple, false);

        /* Test that the collection can be used as array */
        $this->assertEquals($multiple, $collection->toArray());
        $this->assertInternalType('array', $collection->toArray());
        $this->assertInstanceOf(\Traversable::class, $collection);
        $this->assertFalse($collection->isEmpty());
        $this->assertEquals($qty, $collection->count());

        /* Test iterator */
        foreach ($collection as $key => $item) {
        }

        $collection[] = 'lol';
        $collection[$qty] = 'lol';

        isset($collection[$qty]);
        unset($collection[$qty]);
        $collection[$qty];

        /* Test clear */
        $collection->clear();
        $this->assertEmpty($collection);

        $this->assertEquals($collection->clone(), $collection->copy());

        return $collection;
    }
}
