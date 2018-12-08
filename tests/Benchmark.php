<?php

require_once 'vendor/autoload.php';

use Amber\Collection\Collection;
use Lavoiesl\PhpBenchmark\Benchmark;
use Ds\Vector;

//declare(ticks=1);

$benchmark = new Benchmark();

$n = 10000;

$benchmark->add('array', function () use ($n) {
    $array = [];

    for ($x=0; $x < $n; $x++) {
        $array[] = $x;
    }

    foreach ($array as $value) {
        $value;
    }

    for ($x=0; $x < $n; $x++) {
        isset($array[$x]);
    }

    for ($x=0; $x < $n; $x++) {
        unset($array[$x]);
    }

    return $array;
});

$benchmark->add('collection-as-array', function () use ($n) {
    $collection = new Collection();

    for ($x=0; $x < $n; $x++) {
        $collection[$x] = $x;
    }

    for ($x=0; $x < $n; $x++) {
        $collection[$x];
    }

    for ($x=0; $x < $n; $x++) {
        isset($collection[$x]);
    }

    for ($x=0; $x < $n; $x++) {
        unset($collection[$x]);
    }

    return $collection;
});

$benchmark->add('collection-as-object', function () use ($n) {
    $collection = new Collection();

    for ($x=0; $x < $n; $x++) {
        $collection->put($x, $x);
    }

    for ($x=0; $x < $n; $x++) {
        $collection->get($x);
    }

    for ($x=0; $x < $n; $x++) {
        $collection->has($x);
    }

    for ($x=0; $x < $n; $x++) {
        $collection->delete($x);
    }

    return $collection;
});

$benchmark->add('arrobject', function () use ($n) {
    $collection = new \ArrayObject();

    for ($x=0; $x < $n; $x++) {
        $collection[$x] = $x;
    }

    for ($x=0; $x < $n; $x++) {
        $collection[$x];
    }

    for ($x=0; $x < $n; $x++) {
        isset($collection[$x]);
    }

    for ($x=0; $x < $n; $x++) {
        unset($collection[$x]);
    }

    return $collection;
});

$benchmark->add('vector', function () use ($n) {
    $collection = new Vector();

    for ($x=0; $x < $n; $x++) {
        $collection->insert($x, $x);
    }

    for ($x=0; $x < $n; $x++) {
        $collection->get($x);
    }

    for ($x=0; $x < $n; $x++) {
        isset($collection[$x]);
    }

    for ($x=$n-1; $x > 0; $x--) {
        $collection->remove($x);
    }

    return $collection;
});

$benchmark->add('laravel-collection', function () use ($n) {
    $collection = collect();

    for ($x=0; $x < $n; $x++) {
        $collection->put($x, $x);
    }

    for ($x=0; $x < $n; $x++) {
        $collection->get($x);
    }

    for ($x=0; $x < $n; $x++) {
        $collection->has($x);
    }

    for ($x=0; $x < $n; $x++) {
        $collection->pull($x);
    }

    return $collection;
});

$benchmark->add('array-multi', function () use ($n) {
    $array = [];

    for ($x=0; $x < $n; $x++) {
        $array['first']['second']['third'][] = $x;
    }

    foreach ($array['first']['second']['third'] as $value) {
        $value;
    }

    for ($x=0; $x < $n; $x++) {
        isset($array['first']['second']['third'][$x]);
    }

    for ($x=0; $x < $n; $x++) {
        unset($array['first']['second']['third'][$x]);
    }

    return $array;
});

$benchmark->add('collection-as-array-multi', function () use ($n) {
    $collection = new Collection();

    for ($x=0; $x < $n; $x++) {
        $collection['first']['second']['third'][$x] = $x;
    }

    for ($x=0; $x < $n; $x++) {
        $collection['first']['second']['third'][$x];
    }

    for ($x=0; $x < $n; $x++) {
        isset($collection['first']['second']['third'][$x]);
    }

    for ($x=0; $x < $n; $x++) {
        unset($collection['first']['second']['third'][$x]);
    }

    return $collection;
});

$benchmark->add('collection-as-object-multi', function () use ($n) {
    $collection = new Collection();

    for ($x=0; $x < $n; $x++) {
        $collection->put("first.second.third.{$x}", $x);
    }

    for ($x=0; $x < $n; $x++) {
        $collection->get("first.second.third.{$x}");
    }

    for ($x=0; $x < $n; $x++) {
        $collection->has("first.second.third.{$x}");
    }

    for ($x=0; $x < $n; $x++) {
        $collection->delete("first.second.third.{$x}");
    }

    return $collection;
});

$benchmark->add('arrobject-multi', function () use ($n) {
    $collection = new \ArrayObject();

    for ($x=0; $x < $n; $x++) {
        $collection['first']['second']['third'][$x] = $x;
    }

    for ($x=0; $x < $n; $x++) {
        $collection['first']['second']['third'][$x];
    }

    for ($x=0; $x < $n; $x++) {
        isset($collection['first']['second']['third'][$x]);
    }

    for ($x=0; $x < $n; $x++) {
        unset($collection['first']['second']['third'][$x]);
    }

    return $collection;
});

$benchmark->guessCount(10);
//$benchmark->setCount(10000);

$benchmark->run();
