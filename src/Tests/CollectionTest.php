<?php

namespace Amber\Collection\Tests;

use Amber\Collection\Collection;

use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase
{
    public function testCollection()
    {
        $array = [
            'id' => null,
            'name' => 'Pruebas',
            'pass' => 'password',
            'email' =>  null,
        ];

        for ($x = 1; $x <= 2; $x++) {
            $multiple[] = [
                'id' => $x,
                'name' => $array['name'].$x,
                'pass' => $array['pass'].$x,
                'email' => "email{$x}@email.com",
            ];
        }

        $collection = new Collection($multiple);

        $this->assertEquals($multiple, $collection->toArray());

        /* Test select() */

        /* Test where() */

        /* Test whereNot() */

        /* Test whereIn() */

        /* Test whereNotIn() */

        /* Test orderBy() */
        $this->assertEquals(
            array_reverse($multiple),
            $collection->orderBy('id', 'DESC')->toArray()
        );

        /*print_r($collection->select('id'));
        print_r($collection->where('id', 1));
        print_r($collection->whereNot('id', 2));
        print_r($collection->whereIn('id', [1,3]));
        print_r($collection->whereNotIn('id', [2,4]));*/
        //print_r($collection->orderBy('name', 'DESC'));

        return $collection;
    }
}
