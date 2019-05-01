<?php

namespace Tests\Traits;


trait ArrayFunctionsTrait
{
    public function testExceptAndOnly()
    {
        $collection = $this->newCollection();

        $collection->setMultiple(['value1', 'value2', 'value3']);

        $this->assertEquals(['value1', 'value2', 'value3'], $collection->toArray());
        $this->assertEquals(['value1', 'value3'], $collection->except(['value2'])->toArray());
        $this->assertEquals(['value1'], $collection->only(['value1'])->toArray());
        
        $collection->clear();
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
        $collection = $this->newCollection();
        $this->assertTrue($collection->random()->isEmpty());

        $array = [0,1,2,3,4,5];
        $collection = $this->newCollection($array);

        $random1 = $collection->random();
        $random2 = $collection->random(3);

        $this->assertTrue(in_array($random1->first(), $collection->all()));

        foreach ($random2 as $value) {
            $this->assertTrue(in_array($value, $collection->all()));
        }
    }

    public function testUnique()
    {
        $array = [1, 3, 5, 3, 7, 2, 7, 5];
        $collection = $this->newCollection($array);
    
        $unique = array_unique($array);
        sort($unique);

        $this->assertEquals(
            $unique,
            $collection->unique()->sort()->toArray()
        );
    }

    public function testIntersect()
    {
        $array1 = [1, 2, 3, 4, 5];
        $array2 = [3, 4, 5, 6, 7];
        $collection = $this->newCollection($array1);

        $array = array_intersect($array1, $array2);
        sort($array);

        $this->assertEquals(
            $array,
            $collection->intersect($array2)->sort()->toArray()
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
}