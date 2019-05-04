<?php

namespace Tests;

use Amber\Collection\Bag as Collection;
use Amber\Collection\Vector;
use PHPUnit\Framework\TestCase;
use Tests\Traits\{
    MultipleTrait,
    AssociativeCollectionTrait,
    ArrayFunctionsTrait,
    MixedKeysTrait,
    StatementsTrait,
    CommonTrait
};

class BagTest extends TestCase
{
    use
        CommonTrait,
        ArrayFunctionsTrait,
        StatementsTrait
    ;

    protected $collection = Collection::class;

    private static function newArray(int $n = 5)
    {
        for ($x = 0; $x < $n; $x++) {
            $multiple[$x] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];
        }

        return $multiple;
    }

    public function testBasic()
    {
        $collection = $this->newCollection();

        // Sets a value
        $this->assertNull($collection->set('value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has('value'));

        // Gets the value
        $this->assertEquals('value', $collection->get('value'));
        $this->assertEquals('value', $collection->value);
        $this->assertEquals('value', $collection['value']);
        
        // Deletes the item
        $this->assertTrue($collection->delete('value'));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete('value'));
        $this->assertFalse($collection->has('value'));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get('value1'));
    }
    
    public function testAddUpdate()
    {
        $collection = $this->newCollection();

        $this->assertTrue($collection->add('value'));
        $this->assertTrue($collection->has('value'));

        $this->assertEquals('value', $collection->get('value'));

        $this->assertFalse($collection->add('value'));
        
        $this->assertTrue($collection->update('value', 'new'));
        $this->assertFalse($collection->has('value'));
        $this->assertTrue($collection->has('new'));

        $this->assertEquals('new', $collection->get('new'));
        $this->assertNull($collection->get('value'));

        $this->assertFalse($collection->update('value', 'new'));

    }

    public function testMultiple()
    {
        $array = static::newArray();
        $collection = $this->newCollection();

        $this->assertNull($collection->setMultiple($array));

        $this->assertEquals($array, $collection->getMultiple(array_values($array)));

        $this->assertTrue($collection->hasMultiple(array_values($array)));

        $this->assertNull($collection->unsetMultiple(array_values($array)));

        $this->assertFalse($collection->hasMultiple(array_values($array)));
    }

    public function testAsArrayNumeric()
    {
        $collection = $this->newCollection();

        // Sets a value
        $collection[] = 'value';

        // Checks that the value is set in the collection
        isset($collection[0]);

        // Gets the value
        $this->assertEquals('value', $collection[0]);
        
        // Deletes the item
        unset($collection[0]);

        // Checks that the item is not present in the collection
        $this->assertFalse(isset($collection[0]));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection[0]);
    }

    public function testNumericCollection()
    {
        $collection = $this->newCollection();

        $collection->append('value');
            
        $this->assertTrue($collection->contains('value'));

        $this->assertEquals('value', $collection->get('value'));
        $this->assertEquals('value', $collection->first());
        $this->assertEquals('value', $collection->last());
        
        $this->assertEquals(['value'], $collection->values());

        $collection->prepend('first');
        $collection->append('last');

        $this->assertNotEquals('value', $collection->first());
        $this->assertNotEquals('value', $collection->last());

        $this->assertEquals('first', $collection->first());
        $this->assertEquals('last', $collection->last());
        
        $this->assertEquals(['first', 'value', 'last'], $collection->values());

        $this->assertEquals('value', $collection->remove('value'));
        $this->assertEquals('first', $collection->remove('first'));
        $this->assertEquals('last', $collection->remove('last'));

        $this->assertFalse($collection->contains('first'));
        $this->assertNull($collection->remove('first'));
        $this->assertFalse($collection->contains('value'));
        $this->assertFalse($collection->contains('last'));
    }
}
