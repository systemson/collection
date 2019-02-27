<?php

namespace Tests;

use Amber\Config\ConfigAwareTrait;
use Amber\Collection\SimpleCollection as Collection;
use Amber\Collection\CollectionAware\CollectionAwareClass;
use PHPUnit\Framework\TestCase;

class MultipleTraitTest extends TestCase
{
    private static function newArray(int $n = 5)
    {
        for ($x = 1; $x <= $n; $x++) {
            $multiple['key' . $x] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];
        }

        return $multiple;
    }

    public function testMultiple()
    {
    	$array = static::newArray();
    	$collection = new Collection();

    	$this->assertNull($collection->setMultiple($array));

    	$this->assertEquals($array, $collection->getMultiple(array_keys($array)));

    	$this->assertTrue($collection->hasMultiple(array_keys($array)));
    }
}
