<?php

namespace Tests;

use Amber\Config\ConfigAwareTrait;
use Amber\Collection\Collection;
use Amber\Collection\CollectionAware\CollectionAwareClass;
use PHPUnit\Framework\TestCase;

class CollectionAwareTest extends TestCase
{
    public function testCollectionAware()
    {
        $container = $this->getMockForAbstractClass(CollectionAwareClass::class);

        $collection = new Collection();

        $this->assertNull($container->setCollection($collection));

        $this->assertEquals([], $container->getCollection()->all());

        $this->assertInstanceOf(Collection::class, $container->getCollection());

        $class = new \ReflectionClass(CollectionAwareClass::class);
        $method = $class->getMethod('initCollection');
        $method->setAccessible(true);

        $array = [1, 2, 3, 4];
        $output = $method->invoke($container, $array);

        $this->assertEquals($array, $container->getCollection()->toArray());
    }
}
