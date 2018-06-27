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

        for ($x = 0; $x < 10; $x++) {
            $multiple[] = [
                'id' => $x,
                'name' => $array['name'].$x,
                'pass' => $array['pass'].$x,
                'email' => "email{$x}@email.com",
            ];
        }

        $collection = new Collection($multiple);

        print_r($collection->select('id', 'name', 'email'));

        return $collection;
    }
}
