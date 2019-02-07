<?php

namespace Tests;

use Amber\Collection\Collection;
use PHPUnit\Framework\TestCase;

class StatementsTest extends TestCase
{
    public function testStatements()
    {
        /*$this->markTestSkipped(
          'This test has not been implemented yet.'
        );*/

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


            $roles[] = [
                'role_name' => 'Role' . $x,
                'user_id' => $x,
            ];

            $grouped[$array[$x - 1]['name']] = $array[$x - 1];
        }

        $collection = new Collection($array);

        /* Test select() */
        $this->assertEquals(
            $ids_only,
            $collection->select('id')->toArray()
        );

        /* Test where() */
        $this->assertEquals(
            [0 => $array[1]],
            $collection->where('id', 2)->toArray()
        );

        /* Test whereNot() */
        $whereNot = $array;
        unset($whereNot[1]);

        $this->assertEquals(
            array_values($whereNot),
            $collection->whereNot('id', 2)->toArray()
        );

        /* Test whereIn() */
        $this->assertEquals(
            [0 => $array[0], 1 => $array[2]],
            $collection->whereIn('id', [1, 3])->toArray()
        );

        /* Test whereNotIn() */
        $whereNotIn = $array;
        unset($whereNotIn[0]);
        unset($whereNotIn[2]);

        $this->assertEquals(
            array_values($whereNotIn),
            $collection->whereNotIn('id', [1, 3])->toArray()
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

        $this->assertEquals(
            $array,
            $ordered->orderBy('id')->toArray()
        );

        $this->assertEquals(
            $grouped,
            $collection->groupBy('name')->toArray()
        );

        $collection->clear();

        /* Retuns the new added key's value */
        $this->assertEquals(
            'value',
            $collection->firstOrNew('key', 'value')
        );

        /* Returns the initial value */
        $this->assertEquals(
            'value',
            $collection->firstOrNew('key', 'new_value')
        );

        /* Updates the key and returns the new value */
        $this->assertEquals(
            'new_value',
            $collection->updateOrNew('key', 'new_value')
        );

        /* Retuns the new added key's value */
        $this->assertEquals(
            'another_value',
            $collection->updateOrNew('key1', 'another_value')
        );

        $collection->clear();

        $collection = new Collection($array);

        for ($x = 1; $x <= $qty; $x++) {
            $user_roles[] = array_merge($array[$x-1], $roles[$x-1]);
        }

        $this->assertEquals(
            $user_roles,
            $collection->join($roles, 'id', 'user_id')->toArray()
        );

        return $collection;
    }
}
