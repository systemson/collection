<?php

require_once 'vendor/autoload.php';

use Amber\Collection\Map;
use Amber\Collection\TreeMap;
use Amber\Collection\Base\ArrayObject as AmberArrayObject;
use Amber\Collection\MultilevelCollection as Collection;
use Amber\Collection\Collection as SimpleCollection;
use Lavoiesl\PhpBenchmark\Benchmark;
use Doctrine\Common\Collections\ArrayCollection;

//declare(ticks=1);

$benchmark = new Benchmark();

$n = 10;
/*
$benchmark->add(
    'array',
    function () use ($n) {
        $array = [];

        for ($x = 0; $x < $n; $x++) {
            $array[] = $x;
        }

        foreach ($array as $value) {
            $value;
        }

        for ($x = 0; $x < $n; $x++) {
            isset($array[$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($array[$x]);
        }

        return $array;
    }
);

$benchmark->add(
    'collection-as-array',
    function () use ($n) {
        $collection = new SimpleCollection();

        for ($x = 0; $x < $n; $x++) {
            $collection[$x] = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection[$x];
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection[$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection[$x]);
        }

        return $collection;
    }
);

$benchmark->add(
    'map-as-array',
    function () use ($n) {
        $collection = new Map();

        for ($x = 0; $x < $n; $x++) {
            $collection[$x] = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection[$x];
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection[$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection[$x]);
        }

        return $collection;
    }
);

$benchmark->add(
    'laravel-as-array',
    function () use ($n) {
        $collection = collect();

        for ($x = 0; $x < $n; $x++) {
            $collection[$x] = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection[$x];
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection[$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection[$x]);
        }

        return $collection;
    }
);

$benchmark->add(
    'doctrine-as-array',
    function () use ($n) {
        $collection = new ArrayCollection();

        for ($x = 0; $x < $n; $x++) {
            $collection[$x] = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection[$x];
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection[$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection[$x]);
        }

        return $collection;
    }
);

$benchmark->add(
    'arrobject',
    function () use ($n) {
        $collection = new ArrayObject();

        for ($x = 0; $x < $n; $x++) {
            $collection[$x] = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection[$x];
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection[$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection[$x]);
        }

        return $collection;
    }
);

echo PHP_EOL . 'Test as array' . PHP_EOL;
$benchmark->run();
$benchmark = new Benchmark();

$benchmark->add(
    'collection-as-property',
    function () use ($n) {
        $collection = new SimpleCollection();

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x} = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x};
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection->{$x});
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection->{$x});
        }

        return $collection;
    }
);

$benchmark->add(
    'map-as-property',
    function () use ($n) {
        $collection = new Map();

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x} = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x};
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection->{$x});
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection->{$x});
        }

        return $collection;
    }
);

$benchmark->add(
    'treemap-as-property',
    function () use ($n) {
        $collection = new Map();

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x} = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x};
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection->{$x});
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection->{$x});
        }

        return $collection;
    }
);

$benchmark->add(
    'laravel-as-property',
    function () use ($n) {
        $collection = collect();

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x} = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x};
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection->{$x});
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection->{$x});
        }

        return $collection;
    }
);

$benchmark->add(
    'doctrine-as-property',
    function () use ($n) {
        $collection = new ArrayCollection();

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x} = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->{$x};
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection->{$x});
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection->{$x});
        }

        return $collection;
    }
);

echo PHP_EOL . 'Test as property' . PHP_EOL;
$benchmark->run();
$benchmark = new Benchmark();

$benchmark->add(
    'collection-as-object',
    function () use ($n) {
        $collection = new SimpleCollection();

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->unset($x);
        }

        return $collection;
    }
);

$benchmark->add(
    'multilevel-collection-as-object',
    function () use ($n) {
        $collection = new Collection([], true);

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->unset($x);
        }

        return $collection;
    }
);

$benchmark->add(
    'map-as-object',
    function () use ($n) {
        $collection = new Map();

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->unset($x);
        }

        return $collection;
    }
);

$benchmark->add(
    'treemap-as-object',
    function () use ($n) {
        $collection = new TreeMap();

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->unset($x);
        }

        return $collection;
    }
);

$benchmark->add(
    'laravel-as-object',
    function () use ($n) {
        $collection = collect();

        for ($x = 0; $x < $n; $x++) {
            $collection->put($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->forget($x);
        }

        return $collection;
    }
);

$benchmark->add(
    'doctrine-as-object',
    function () use ($n) {
        $collection = new ArrayCollection();

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->contains($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->remove($x);
        }

        return $collection;
    }
);

echo PHP_EOL . 'Test as object' . PHP_EOL;
$benchmark->run();
$benchmark = new Benchmark();

$benchmark->add(
    'array-multi',
    function () use ($n) {
        $array = [];

        for ($x = 0; $x < $n; $x++) {
            $array['first']['second']['third'][] = $x;
        }

        foreach ($array['first']['second']['third'] as $value) {
            $value;
        }

        for ($x = 0; $x < $n; $x++) {
            isset($array['first']['second']['third'][$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($array['first']['second']['third'][$x]);
        }

        return $array;
    }
);

$benchmark->add(
    'collection-as-array-multi',
    function () use ($n) {
        $collection = new SimpleCollection();

        for ($x = 0; $x < $n; $x++) {
            $collection['first']['second']['third'][$x] = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection['first']['second']['third'][$x];
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection['first']['second']['third'][$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection['first']['second']['third'][$x]);
        }

        return $collection;
    }
);

$benchmark->add(
    'collection-as-object-multi',
    function () use ($n) {
        $collection = new Collection([], true);

        for ($x = 0; $x < $n; $x++) {
            $collection->put("first.second.third.{$x}", $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get("first.second.third.{$x}");
        }

        for ($x = 0; $x < $n; $x++) {
            //$collection->has("first.second.third.{$x}");
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->delete("first.second.third.{$x}");
        }

        return $collection;
    }
);

$benchmark->add(
    'arrobject-multi',
    function () use ($n) {
        $collection = new \ArrayObject();

        for ($x = 0; $x < $n; $x++) {
            $collection['first']['second']['third'][$x] = $x;
        }

        for ($x = 0; $x < $n; $x++) {
            $collection['first']['second']['third'][$x];
        }

        for ($x = 0; $x < $n; $x++) {
            isset($collection['first']['second']['third'][$x]);
        }

        for ($x = 0; $x < $n; $x++) {
            unset($collection['first']['second']['third'][$x]);
        }

        return $collection;
    }
);

//$benchmark->guessCount(10);
//$benchmark->setCount(10000);

echo PHP_EOL . 'Test as multilevel' . PHP_EOL;
$benchmark->run();
*/
$benchmark = new Benchmark();

$benchmark->add(
    'simple-collection',
    function () use ($n) {
        $collection = new SimpleCollection();

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->unset($x);
        }

        return $collection;
    }
);

$benchmark->add(
    'multilevel-collection',
    function () use ($n) {
        $collection = new Collection([], true);

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->unset($x);
        }

        return $collection;
    }
);

$benchmark->add(
    'map-collection',
    function () use ($n) {
        $collection = new Map();

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->unset($x);
        }

        return $collection;
    }
);

$benchmark->add(
    'treemap-collection',
    function () use ($n) {
        $collection = new TreeMap();

        for ($x = 0; $x < $n; $x++) {
            $collection->set($x, $x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->get($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->has($x);
        }

        for ($x = 0; $x < $n; $x++) {
            $collection->unset($x);
        }

        return $collection;
    }
);

echo PHP_EOL . 'Test amber collections as objects' . PHP_EOL;
$benchmark->run();