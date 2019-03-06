<?php

namespace Tests;

use Amber\Config\ConfigAwareTrait;
use Amber\Collection\SimpleCollection as Collection;
use Amber\Collection\CollectionAware\CollectionAwareClass;
use PHPUnit\Framework\TestCase;

class ArrayFunctionsTraitTest extends TestCase
{
    private static function newArray(int $n = 5)
    {
        for ($x = 1; $x <= $n; $x++) {
            $multiple[] = [
                'id'    => $x,
                'name'  => 'Pruebas' . $x,
                'pass'  => 'pass' . $x,
                'email' => "email{$x}@email.com",
            ];
        }

        return $multiple;
    }

    public function testMap()
    {
        $multiple = static::newArray();
        $collection = new Collection($multiple);

        $callback = function ($value) {
            return $value + $value;
        };

        $this->assertEquals(
            array_map($callback, $multiple),
            $collection->map($callback)->toArray()
        );
    }

    public function testFilter()
    {
        $multiple = static::newArray();
        $collection = new Collection($multiple);

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
        $collection = new Collection($multiple);

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
        $collection = new Collection($multiple);

        $this->assertEquals(
            array_reverse($multiple),
            $collection->reverse()->toArray()
        );
    }

    public function testMerge()
    {
        $multiple = static::newArray();
        $collection = new Collection($multiple);

        $this->assertEquals(
            array_merge($multiple, $multiple),
            $collection->merge($multiple)->toArray()
        );
    }

    public function testChunk()
    {
        $multiple = static::newArray();
        $collection = new Collection($multiple);

        $this->assertEquals(
            array_chunk($multiple, 2),
            $collection->chunk(2)->toArray()
        );
    }

    public function testColumn()
    {
        $multiple = static::newArray();
        $collection = new Collection($multiple);

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
        $collection = new Collection($ids);

        $this->assertEquals(
            array_flip($ids),
            $collection->flip()->toArray()
        );
    }
}
