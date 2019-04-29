<?php

namespace Tests;

use Amber\Collection\Set as Collection;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    private static function newArray(int $n = 5, string $key = '')
    {
        for ($x = 1; $x <= $n; $x++) {
            $multiple["{$key}{$x}"] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];
        }

        return $multiple;
    }

    private function newCollection()
    {
    	return new Collection();
    }

    public function testBasic()
    {
        $collection = $this->newCollection();

        // Sets a value
        $this->assertNull($collection->set('key', 'value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has('value'));

        // Gets the value
        $this->assertEquals('value', $collection->get('value'));
        $this->assertEquals('value', $collection->key);
        $this->assertEquals('value', $collection['value']);
        
        // Deletes the item
        $this->assertTrue($collection->delete('value'));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete('value'));
        $this->assertFalse($collection->has('value'));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get('value1'));
    }
}
