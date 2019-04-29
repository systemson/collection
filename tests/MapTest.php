<?php

namespace Tests;

use Amber\Collection\Map as Collection;
use Amber\Collection\TreeMap;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase
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

    private function newCollection(array $array = [])
    {
    	return new Collection($array);
    }

    public function testBasic()
    {
        $collection = $this->newCollection();

        // Sets a value
        $this->assertNull($collection->set('key', 'value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has('key'));

        // Gets the value
        $this->assertEquals('value', $collection->get('key'));
        //$this->assertEquals('value', $collection->key);
        $this->assertEquals('value', $collection['key']);
        
        // Deletes the item
        $this->assertTrue($collection->delete('key'));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete('key'));
        $this->assertFalse($collection->has('key'));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get('key1'));
    }

    public function testObjectKeys()
    {
        $collection = $this->newCollection();

        $key = new \stdClass();

        // Sets a value
        $this->assertNull($collection->set($key, 'value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has($key));

        // Gets the value
        $this->assertEquals('value', $collection->get($key));
        
        // Deletes the item
        $this->assertTrue($collection->delete($key));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete($key));
        $this->assertFalse($collection->has($key));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get($key));
    }

    public function testTreeMap()
    {
        $collection = new TreeMap();

        // Sets a value
        $this->assertNull($collection->set('key', 'value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has('key'));

        // Gets the value
        $this->assertEquals('value', $collection->get('key'));
        
        // Deletes the item
        $this->assertTrue($collection->delete('key'));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete('key'));
        $this->assertFalse($collection->has('key'));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get('key1'));
    }

    public function testTreeMapInsensitiveKeys()
    {
        $collection = new TreeMap();

        $collection->setComparator(function ($key, $offset) {
        	return strtoupper($key) === strtoupper($offset);
        });

        // Sets a value
        $this->assertNull($collection->set('key', 'value'));

        // Checks that the value is set in the collection
        $this->assertTrue($collection->has('key'));
        $this->assertTrue($collection->has('KEY'));
        $this->assertTrue($collection->has('kEy'));

        // Gets the value
        $this->assertEquals('value', $collection->get('key'));
        $this->assertEquals('value', $collection->get('KEY'));
        $this->assertEquals('value', $collection->get('kEy'));

        // Sets another value
        $this->assertNull($collection->set('key', 'new'));

        // Gets the value
        $this->assertEquals('new', $collection->get('key'));
        $this->assertEquals('new', $collection->get('KEY'));
        $this->assertEquals('new', $collection->get('kEy'));

        // Deletes the item
        $this->assertTrue($collection->delete('keY'));

        // Checks that the item is not present in the collection
        $this->assertFalse($collection->delete('key'));
        $this->assertFalse($collection->delete('KEY'));
        $this->assertFalse($collection->delete('kEy'));
        $this->assertFalse($collection->has('KEY'));
        $this->assertFalse($collection->has('kEy'));

        // Returns null if the item does not exists in the collection.
        $this->assertNull($collection->get('key'));
    }

    public function testMultiple()
    {
        $array = static::newArray();
        $collection = $this->newCollection();

        $this->assertNull($collection->setMultiple($array));

        $this->assertEquals($array, $collection->getMultiple(array_keys($array)));

        $this->assertTrue($collection->hasMultiple(array_keys($array)));

        $this->assertTrue($collection->delete(array_keys($array)[0]));

        $this->assertFalse($collection->hasMultiple(array_keys($array)));
    }

    public function testAssociativeCollection()
    {
        $collection = $this->newCollection();

        /* Tests keys that don't exists */
        $this->assertTrue($collection->hasNot('key'));
        $this->assertTrue($collection->hasNot('key1'));

        /* Tests updating a key that doesn't exists */
        $this->assertFalse($collection->update('key1', 'value'));

        /* Tests adding items */
        $this->assertNull($collection->put('key', 'value'));
        $this->assertTrue($collection->add('key1', 'value1'));

        /* Tests adding an item that already exists */
        /* Insert alias for put */
        $this->assertFalse($collection->add('key1', 'value'));

        /* Tests updating an item */
        $this->assertTrue($collection->update('key1', 'value1'));

        /* Tests that items exist */
        $this->assertTrue($collection->contains('key'));
        $this->assertTrue($collection->contains('key1'));

        /* Tests getting items */
        $this->assertEquals('value', $collection->get('key'));
        $this->assertEquals('value1', $collection->find('key1'));
        $this->assertEquals('value', $collection->first());
        $this->assertEquals('value1', $collection->last());

        /* Tests removing an item */
        $this->assertTrue($collection->delete('key'));
        $this->assertEquals('value1', $collection->remove('key1'));
        $this->assertNull($collection->remove('key1'));

        /* Tests that the item doesn't exists */
        $this->assertNull($collection->get('key'));
        $this->assertNull($collection->get('key1'));
        $this->assertFalse($collection->contains('key'));
        $this->assertFalse($collection->contains('key1'));
        $this->assertNull($collection->remove('key'));
        $this->assertNull($collection->remove('key1'));
        $this->assertNull($collection->first());
        $this->assertNull($collection->last());
        
        /* Tests removing an item that doesn't exists */
        $this->assertFalse($collection->delete('key'));
    }

    public function testMap()
    {
        $multiple = static::newArray();
        $collection = $this->newCollection($multiple);

        $callback = function ($value) {
            return $value + $value;
        };

        $this->assertEquals(
            array_map($callback, $multiple),
            $collection->map($callback)->toArray()
        );
        
        $collection->clear();
    }

    public function testFilter()
    {
        $multiple = static::newArray();
        $collection = $this->newCollection($multiple);

        $callback = function ($value) {
            return $value === 1;
        };

        $this->assertEquals(
            array_filter($multiple, $callback),
            $collection->filter($callback)->toArray()
        );
    }

    public function testSort()
    {
        $multiple = static::newArray();
        $collection = $this->newCollection($multiple);

        $callback = function ($a, $b) {
            return $b['id'] <=> $a['id'] ;
        };

        usort($multiple, $callback);

        $this->assertEquals(
            $multiple,
            $collection->sort($callback)->toArray()
        );
    }

    public function testReverse()
    {
        $multiple = static::newArray();
        $collection = $this->newCollection($multiple);

        $this->assertEquals(
            array_reverse($multiple),
            $collection->reverse()->toArray()
        );
    }

    public function testMerge()
    {
        $multiple = static::newArray();
        $collection = $this->newCollection($multiple);

        $this->assertEquals(
            array_merge($multiple, $multiple),
            $collection->merge($multiple)->toArray()
        );
    }

    public function testChunk()
    {
        $multiple = static::newArray();
        $collection = $this->newCollection($multiple);

        $this->assertEquals(
            array_chunk($multiple, 2),
            $collection->chunk(2)->toArray()
        );
    }

    public function testColumn()
    {
        $multiple = static::newArray();
        $collection = $this->newCollection($multiple);

        $this->assertEquals(
            $ids = array_column($multiple, 'id'),
            $collection->column('id')->toArray()
        );

        return $ids;
    }

    /**
     * @depends testColumn
     */
    public function testFlip(array $ids)
    {
        $collection = $this->newCollection($ids);

        $this->assertEquals(
            array_flip($ids),
            $collection->flip()->toArray()
        );
    }

    public function testRandom()
    {
        $multiple = static::newArray();
        $collection = $this->newCollection($multiple);

        $random1 = $collection->random();
        $random2 = $collection->random(3);

        $this->assertEquals(
        	$random1->keys(),
        	$random1->column('id')->toArray()
        );

        $this->assertEquals(
        	$random2->keys(),
        	$random2->column('id')->toArray()
        );
    }

    public function testUnique()
    {
    	$array = [1, 3, 5, 3, 7, 2, 7, 5];
        $collection = $this->newCollection($array);

        $this->assertEquals(
        	array_unique($array),
        	$collection->unique()->toArray()
        );
    }

    public function testIntersect()
    {
    	$array1 = [1, 2, 3, 4, 5];
    	$array2 = [3, 4, 5, 6, 7];
        $collection = $this->newCollection($array1);

        $this->assertEquals(
        	array_intersect($array1, $array2),
        	$collection->intersect($array2)->toArray()
        );
    }

    public function testDiff()
    {
    	$array1 = [1, 2, 3, 4, 5];
    	$array2 = [3, 4, 5, 6, 7];
        $collection = $this->newCollection($array1);

        $this->assertEquals(
        	array_diff($array1, $array2),
        	$collection->diff($array2)->toArray()
        );
    }

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

        $collection = $this->newCollection($array);

        for ($x = 1; $x <= $qty; $x++) {
            $user_roles[] = array_merge($array[$x - 1], $roles[$x - 1]);
        }

        $this->assertEquals(
            $user_roles,
            $collection->join($roles, 'id', 'user_id')->toArray()
        );

        $collection->exchangeArray($array);
        $this->assertEquals(array_sum(array_column($array, 'id')), $collection->sum('id'));

        $collection->exchangeArray($grouped);
        $this->assertEquals(array_sum(array_column($grouped, 'id')), $collection->sum('id'));
    }

    public function testInsert()
    {
        $collection = $this->newCollection();

    	$this->assertTrue($collection->insert('key', 'value'));
    	$this->assertFalse($collection->insert('key', 'value'));

    	$this->assertTrue($collection->has('key'));
    	$this->assertEquals('value', $collection->get('key'));
    }

    public function testClone()
    {
        $collection = $this->newCollection();

    	$this->assertInstanceOf(Collection::class, $collection->clone());

    	$this->assertEquals(clone $collection, $collection->clone());
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

    public function testEssentials()
    {
        $collection = $this->newCollection();

        $this->assertInstanceOf(Collection::class, $collection);

        $collection->set('key', 'value');

        $this->assertEquals(['key' => 'value'], $collection->toArray());
        $this->assertEquals(['key' => 'value'], $collection->all());

        $this->assertEquals(['key'], $collection->keys());

        $this->assertEquals(['value'], $collection->values());

        $this->assertNotSame($collection, $collection->copy());
        $this->assertInstanceOf(Collection::class, $collection->copy());

        $this->assertNotSame($collection, $collection->clone());
        $this->assertInstanceOf(Collection::class, $collection->clone());

        $this->assertEquals(1, $collection->count());

        $this->assertFalse($collection->isEmpty());
        $this->assertTrue($collection->isNotEmpty());

        $this->assertEquals(json_encode(['key' => 'value']), $collection->toJson());
        $this->assertEquals(json_encode(['key' => 'value']), json_encode($collection));

        $this->assertEquals(json_encode(['key' => 'value']), (string) $collection);

        $this->assertNull($collection->clear());

        $this->assertEquals([], $collection->all());
        $this->assertEquals(0, $collection->count());
        $this->assertTrue($collection->isEmpty());
        $this->assertFalse($collection->isNotEmpty());
    }

    public function testImplode()
    {
        $string = 'Hello world';
        $array = explode(' ', $string);

        $collection = Collection::make($array);

        $this->assertEquals($string, $collection->implode(' '));
    }

    public function testMaxMin()
    {
        $array = [0, 1, 2, 3, 5, 8, 13, 21];

        $collection = $this->newCollection($array);

        $this->assertEquals(max($array), $collection->max());
        $this->assertEquals(min($array), $collection->min());
    }

    public function testPushTo()
    {
        $this->expectException(\Exception::class);

        $collection = $this->newCollection();

        $collection->pushTo('key', 'value');
    }


    public function testPush()
    {
        $collection = $this->newCollection();

        $this->expectException(\Exception::class);

        $collection->push('value');
    }
}
