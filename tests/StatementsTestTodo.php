<?php

namespace Tests;

use Amber\Collection\Collection;
use PHPUnit\Framework\TestCase;

class StatementsTest extends TestCase
{
    public function testStatements()
    {
        $this->markTestSkipped(
          'This test has not been implemented yet.'
        );

        $qty = 3;

        for ($x = 1; $x <= $qty; $x++) {
            $array[] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];

            $ids_only[] = [
                'id'    => $x,
            ];
        }

        $collection = new Collection($array);

        /* Test select() */
        $this->assertEquals(
            $ids_only,
            $collection->select('id')->toArray()
        );

        /* Test where() */
        $this->assertEquals(
            [0 => $array[0]],
            $collection->where('id', 1)->toArray()
        );

        /* Test whereNot() */
        $whereNot = $array;
        unset($whereNot[0]);

        $this->assertEquals(
            array_values($whereNot),
            $collection->whereNot('id', 1)->toArray()
        );

        /* Test whereIn() */
        $this->assertEquals(
            [0 => $array[0], 1 => $array[1]],
            $collection->whereIn('id', [1, 2])->toArray()
        );

        /* Test whereNotIn() */
        $whereNotIn = $array;
        unset($whereNotIn[0]);
        unset($whereNotIn[1]);

        $this->assertEquals(
            array_values($whereNotIn),
            $collection->whereNotIn('id', [1, 2])->toArray()
        );

        /* Test orderBy() */
        $ordered = $collection->orderBy('id', 'DESC');
        $this->assertEquals(
            array_reverse($array),
            $ordered->toArray()
        );

        $this->assertEquals(
            $array,
            $ordered->orderBy('id')->toArray()
        );

        return $collection;
    }
}
