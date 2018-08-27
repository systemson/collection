<?php

require_once 'vendor/autoload.php';

use Amber\Collection\Collection;
use Lavoiesl\PhpBenchmark\Benchmark;

$benchmark = new Benchmark();

$n = 10000;

declare(ticks=1);

$benchmark->add('array', function () use ($n) {
    $array = [];

    for ($x=0; $x < $n; $x++) {
        $array[] = $x;
    }

    foreach ($array as $value) {
    }

    for ($x=0; $x < $n; $x++) {
        unset($array[$x]);
    }

    return $array;
});

$benchmark->add('collection', function () use ($n) {
    $collection = new Collection();

    for ($x=0; $x < $n; $x++) {
        $collection[$x] = $x;
    }

    foreach ($collection as $value) {
    }

    for ($x=0; $x < $n; $x++) {
        unset($collection[$x]);
    }

    return $collection;
});

$benchmark->guessCount(10);

$benchmark->run();
