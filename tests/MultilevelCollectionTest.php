<?php

namespace Tests;

use Amber\Collection\Collection;
use PHPUnit\Framework\TestCase;

class MultilevelCollectionTest extends TestCase
{
    public function testMultiLevelCollection()
    {
        $first = 'first';
        $second = 'second';
        $third = 'third';

        $slug = "{$first}.{$second}.{$third}";
        $value = 'value';

        $collection = new Collection();

        $this->assertTrue($collection->set($slug, $value));

        $this->assertTrue($collection->has("$first"));
        $this->assertTrue($collection->has("{$first}.{$second}"));
        $this->assertTrue($collection->has("{$first}.{$second}.{$third}"));

        $this->assertEquals($value, $collection->get("{$first}.{$second}.{$third}"));
        $this->assertEquals([$third => $value], $collection->get("{$first}.{$second}"));
        $this->assertEquals([$second => [$third => $value]], $collection->get("{$first}"));

        $this->assertTrue($collection->delete("{$first}.{$second}.{$third}"));
        $this->assertFalse($collection->has("{$first}.{$second}.{$third}"));

        $this->assertTrue($collection->delete("{$first}.{$second}"));
        $this->assertFalse($collection->has("{$first}.{$second}"));

        $this->assertTrue($collection->delete("{$first}"));
        $this->assertFalse($collection->has("{$first}"));

        //$collection->clear();

        $this->assertTrue($collection->set($slug, $value));

        $this->assertEquals($value, $collection->remove("{$first}.{$second}.{$third}"));
        $this->assertFalse($collection->has("{$first}.{$second}.{$third}"));

        $this->assertEquals([$third => null], $collection->remove("{$first}.{$second}"));
        $this->assertFalse($collection->has("{$first}.{$second}"));

        $this->assertEquals([$second => null], $collection->remove("{$first}"));
        $this->assertFalse($collection->has("$first"));
        var_dump($collection->get($first));

        $this->assertTrue($collection->set("$first", $value));
        $this->assertEquals($value, $collection->get("$first", $value));
    }
}
