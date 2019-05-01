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

        $this->assertEquals([], $container->getCollection()->toArray());

        $this->assertInstanceOf(Collection::class, $container->getCollection());

        $array = [1, 2, 3, 4];
        $new = new Collection($array);

        $this->assertNull($container->setCollection($new));
        $this->assertEquals($array, $container->getCollection()->toArray());
    }
}
