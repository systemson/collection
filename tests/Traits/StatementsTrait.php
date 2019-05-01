<?php

namespace Tests\Traits;

trait StatementsTrait
{
    public function testStatements()
    {
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

        $collection = $this->newCollection($array);

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

        /* Test groupBy() */
        $this->assertEquals(
            $grouped,
            $collection->groupBy('name')->toArray()
        );

        $collection->clear();

        $collection = $this->newCollection($array);

        for ($x = 1; $x <= $qty; $x++) {
            $user_roles[] = array_merge($array[$x - 1], $roles[$x - 1]);
        }

        $this->assertEquals(
            $user_roles,
            $collection->join($roles, 'id', 'user_id')->toArray()
        );

        $collection = $this->newCollection($array);
        $this->assertEquals(array_sum(array_column($array, 'id')), $collection->sum('id'));

        $collection = $this->newCollection($grouped);
        $this->assertEquals(array_sum(array_column($grouped, 'id')), $collection->sum('id'));
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

        $collection = $this->newCollection($array);

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