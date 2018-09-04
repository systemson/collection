<?php

require_once 'vendor/autoload.php';

use Amber\Collection\Collection;
use Lavoiesl\PhpBenchmark\Benchmark;

$benchmark = new Benchmark();

$n = 10;

declare(ticks=1);

$benchmark->add('array', function () use ($n) {
    $array = [];

    for ($x=0; $x < $n; $x++) {
        $array[] = $x;
    }

    foreach ($array as $value) {
        $value;
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
        $collection->{$x};
    }

    for ($x=0; $x < $n; $x++) {
        $collection->remove($x);
    }

    return $collection;
});

//$benchmark->guessCount(10);

$benchmark->run();
