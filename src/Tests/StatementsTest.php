<?php

namespace Amber\Collection\Tests;

use Amber\Collection\Collection;

use PHPUnit\Framework\TestCase;

class StatementsTest extends TestCase
{
    public function testStatements()
    {
        $qty = 2;

        for ($x = 1; $x <= $qty; $x++) {
            $multiple[] = [
                'id' => $x,
                'name' => 'Pruebas'.$x,
                'pass' => 'pass'.$x,
                'email' => "email{$x}@email.com",
            ];
        }

        $collection = new Collection($multiple);

        /* Test select() */

        /* Test where() */

        /* Test whereNot() */

        /* Test whereIn() */

        /* Test whereNotIn() */

        /* Test orderBy() */
        $reversed = $collection->orderBy('id', 'DESC');
        $this->assertEquals(
            array_reverse($multiple),
            $reversed->toArray()
        );
        $this->assertEquals(
            $multiple,
            $reversed->orderBy('id')->toArray()
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
