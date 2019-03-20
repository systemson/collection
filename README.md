[![Latest Stable Version](https://poser.pugx.org/amber/collection/v/stable.png)](https://packagist.org/packages/amber/collection)
[![Latest Beta Version](https://img.shields.io/packagist/vpre/amber/collection.svg)](https://packagist.org/packages/amber/collection)
[![Build Status](https://travis-ci.org/systemson/collection.svg?branch=master)](https://travis-ci.org/systemson/collection)
[![PHP-Eye](https://php-eye.com/badge/amber/collection/tested.svg?style=flat)](https://php-eye.com/package/amber/collection)
[![StyleCI](https://styleci.io/repos/134289550/shield?branch=master)](https://styleci.io/repos/134289550)
[![Coverage Status](https://coveralls.io/repos/github/systemson/collection/badge.svg?branch=master)](https://coveralls.io/github/systemson/collection?branch=master)
[![Total Downloads](https://poser.pugx.org/amber/collection/downloads.png)](https://packagist.org/packages/amber/collection)

# Collection
Wrapper class for working with arrays.

## Usage

With composer
```
composer require amber/collection
```

In your code:
``` php
Use Amber\Collection\Collection;
```

1) Instantiate an empty collection:

``` php
$collection = new Collection();
```

2) Instantiate a collection for an array:
``` php
$array = ['key' => 'value'];

$collection = new Collection($array);
```

3) Or use the static method make:
``` php
$collection = Collection::make();

...

$array = ['key' => 'value'];

$collection = Collection::make($array);
```

## Available methods
- [has](#has)
- [contains](#contains)
- [hasNot](#hasnot)
- [put](#put)
- [add](#add)
- [insert](#insert)
- [update](#update)
- [push](#push)
- [pushTo](#pushto)
- [get](#get)
- [find](#find)
- [first](#first)
- [last](#last)
- [remove](#remove)
- [delete](#delete)
- [map](#map)
- [filter](#filter)
- [sort](#sort)
- [reverse](#reverse)
- [merge](#merge)
- [chunk](#chunk)
- [column](#column)
- [flip](#flip)
- [setMultiple](#setmultiple)
- [getMultiple](#getmultiple)
- [hasMultiple](#hasmultiple)
- [select](#select)
- [where](#where)
- [whereNot](#wherenot)
- [whereIn](#wherein)
- [whereNotIn](#wherenotin)
- [orderBy](#orderby)
- [groupBy](#groupby)
- [join](#join)
- [sum](#sum)
- [firstOrNew](#firstornew)
- [updateOrNew](#updateornew)

### has()
*Whether an item is present it the collection.*

has(string  $key) : boolean
``` php
$collection->set('name', 'Amber');

$collection->has('name'); // returns true.

$collection->has('other'); // returns false.
```

### contains()
*Alias for [has](#has).*

contains(string  $key) : boolean

### hasNot()
*Whether an item is not present it the collection.*

hasNot(string  $key) : boolean
``` php
$collection->set('name', 'Amber');

$collection->hasNot('name'); // returns false.

$collection->hasNot('other'); // returns true.
```

### set()
*Sets or updates an item in the collection.*

set(string  $key, mixed  $value) : void
``` php
$collection->set('name', 'Amber');

$collection->has('name'); // returns true.
```

### put()
*Alias for [set](#set).*

put(string  $key, mixed  $value) : void

### add()
*Sets a new item to the collection.*

add(string  $key, mixed  $value) : boolean
``` php
$collection->add('name', 'Amber'); // returns true.

$collection->add('name', 'Amber'); // returns false, since the item already exists.
```

### insert()
*Alias for [add](#add).*

insert(string  $key, mixed  $value) : boolean

### update()
*Updates an existent item in the collection.*

update(string  $key, mixed  $value) : boolean
``` php
$collection->update('name', 'Amber'); // returns false, since the item doesn't exists in the collecction

$collection->set('name', 'Amber');

$collection->update('name', 'Collection'); // returns true.
```

### push()
*Sets a new item at the end of the collection.*

push(mixed  $value) : void
``` php
$collection->push('apple');
$collection->push('orange');
$collection->push('grapes');

$collection->all(); // returns ['apple', 'orange', 'grapes']
```

### pushTo()
*Push a new item at the end of a item in the collection.*

pushTo(string  $key, mixed  $value) : boolean
``` php
$collection->set('colors', []); // Sets an empty array
$collection->pushTo('colors', 'red');
$collection->pushTo('colors', 'blue');
$collection->pushTo('colors', 'green');

$collection->get('colors'); // returns ['red', 'blue', 'green']
```

### get()
*Gets an item from collection.*

get(string  $key) : mixed|void
``` php
$collection->set('name', 'Amber');

$collection->get('name'); // returns 'Amber'
```

### find()
*Alias for [get](#get).*

find(string  $key) : mixed

### first()
*Returns the first element of the collection.*

first() : mixed
``` php
$collection->push('apple');
$collection->push('orange');
$collection->push('grapes');

$collection->first(); // returns 'apple'
```

### last()
*Returns the last element of the collection.*

last() : mixed
``` php
$collection->push('apple');
$collection->push('orange');
$collection->push('grapes');

$collection->last(); // returns 'grapes'
```

### remove()
*Deletes and retrives an item from collection.*

remove(string  $key) : mixed
``` php
$collection->set('name', 'Amber');

$name = $collection->remove('name');

$collection->has('name'); // returns false

echo $name; // prints 'Amber'
```

### delete()
*Deletes an item from collection.*

delete(string  $key) : boolean
``` php
$collection->set('name', 'Amber');

$collection->delete('name'); // returns true

$collection->delete('name'); // returns false, since the items was aleady deleted
```

### map()
*Iterates through the collection and passes each value to the given callback.*

map(\Closure  $callback) : \Amber\Collection\Base\Collection
``` php
$collection->push('apple');
$collection->push('orange');
$collection->push('grapes');

$maped = $collection->map(function ($value) {
    return ucfirst($value);
});

$maped->all(); // returns ['Apple', 'Orange', 'Grapes']
```

### filter()
*Returns a new filtered collection using a user-defined function.*

filter(\Closure  $callback) : \Amber\Collection\Base\Collection
``` php
$collection->push('apple');
$collection->push('orange');
$collection->push('grapes');

$filtered = $collection->filter(function ($value) {
    return $value == 'apple';
});

$filtered->all(); // returns ['apple']
```

### sort()
*Returns a new sorted collection using a user-defined comparison function.*

sort(\Closure  $callback) : \Amber\Collection\Base\Collection
``` php
$collection->push(3);
$collection->push(5);
$collection->push(2);

$sorted = $collection->filter(function ($a, $b) {
    return $a <=> $b;
});

$sorted->all(); // returns [2, 3, 5]
```

### reverse()
*Returns a new reversed collection.*

reverse() : \Amber\Collection\Base\Collection
``` php
$collection->push(1);
$collection->push(2);
$collection->push(3);

$reversed = $collection->reverse();

$reversed->all() // returns [3, 2, 1]
```

### merge()
*Returns a new collection merged with one or more arrays.*

merge(array  $array) : \Amber\Collection\Base\Collection
``` php
$collection->push(1);
$collection->push(2);
$collection->push(3);

$collection->all(); // returns [1, 2, 3]

$array = [4, 5, 6];

$merged = $collection->merge($array);

$merged->all() // returns [1, 2, 3, 4, 5, 6]
```

### chunk()
*Splits an array into chunks.*

chunk(integer  $size, boolean  $preserve_keys = false) : \Amber\Collection\Base\Collection

### column()
*Returns the values from a single column.*

column(string  $column) : \Amber\Collection\Base\Collection
``` php
$collection->push(['id' => '1', 'color' => 'red', 'name' => 'Fire']);
$collection->push(['id' => '2', 'color' => 'blue', 'name' => 'Sea']);
$collection->push(['id' => '3', 'color' => 'green', 'name' => 'Forest']);

$colors = $collection->column('color');

$colors->all(); // returns ['red', 'blue', 'green']
```

### flip()
*Exchanges all keys with their associated values.*

flip() : \Amber\Collection\Base\Collection
``` php
$collection->set('color' => 'red');

$fliped = $collection->flip();

$fliped->all(); // returns ['red' => 'color']
```

### setMultiple()
*Sets or updates an array of items in the collection, and returns true on success.*

setMultiple(array  $array) : void

### getMultiple()
*Gets multiple items from the collection.*

getMultiple(array  $array) : mixed

### hasMultiple()
*Whether multiple items are present in the collection.*

hasMultiple(array  $array) : boolean

### select()
*Returns a new Collection containing the items in the specified column(s).*

select(array|string  $columns) : \Amber\Collection\Base\Collection
``` php
$collection->push(['id' => '1', 'color' => 'red', 'name' => 'Fire']);
$collection->push(['id' => '2', 'color' => 'blue', 'name' => 'Sea']);
$collection->push(['id' => '3', 'color' => 'green', 'name' => 'Forest']);

$items = $collection->select('id', 'color');

$items->all(); // returns [[1, 'red'], [2, 'blue'], [3, 'green']]
```

### where()
*Returns a new Collection containing the items in the specified column that are equal to the especified value.*

where(string  $column, mixed  $value) : \Amber\Collection\Base\Collection
``` php
$collection->push(['id' => '1', 'color' => 'red', 'name' => 'Fire']);
$collection->push(['id' => '2', 'color' => 'blue', 'name' => 'Sea']);
$collection->push(['id' => '3', 'color' => 'green', 'name' => 'Forest']);

$filtered = $collection->where('color', 'red');

$filtered->all(); // returns ['id' => '1', 'color' => 'red', 'name' => 'Fire']
```

### whereNot()
*Returns a new Collection containing the items in the specified column that are not equal to the especified value.*

whereNot(string  $column, mixed  $value) : \Amber\Collection\Base\Collection
``` php
$collection->push(['id' => '1', 'color' => 'red', 'name' => 'Fire']);
$collection->push(['id' => '2', 'color' => 'blue', 'name' => 'Sea']);
$collection->push(['id' => '3', 'color' => 'green', 'name' => 'Forest']);

$filtered = $collection->whereNot('color', 'red');

$filtered->all();
// returns [
    ['id' => '2', 'color' => 'blue', 'name' => 'Sea'],
    ['id' => '3', 'color' => 'green', 'name' => 'Forest']
]
```

### whereIn()
*Returns a new Collection containing the items in the specified column that are equal to the especified value(s).*

whereIn(string  $column, array  $values = array()) : \Amber\Collection\Base\Collection
``` php
$collection->push(['id' => '1', 'color' => 'red', 'name' => 'Fire']);
$collection->push(['id' => '2', 'color' => 'blue', 'name' => 'Sea']);
$collection->push(['id' => '3', 'color' => 'green', 'name' => 'Forest']);

$filtered = $collection->whereIn('color', ['blue', 'green']);

$filtered->all();
// returns [
    ['id' => '2', 'color' => 'blue', 'name' => 'Sea'],
    ['id' => '3', 'color' => 'green', 'name' => 'Forest']
]
```

### whereNotIn()
*Returns a new Collection containing the items in the specified column that are not equal to the especified value(s).*

whereNotIn(string  $column, array  $values = array()) : \Amber\Collection\Base\Collection
``` php
$collection->push(['id' => '1', 'color' => 'red', 'name' => 'Fire']);
$collection->push(['id' => '2', 'color' => 'blue', 'name' => 'Sea']);
$collection->push(['id' => '3', 'color' => 'green', 'name' => 'Forest']);

$filtered = $collection->whereNotIn('color', ['blue', 'green']);

$filtered->all(); // returns ['id' => '1', 'color' => 'red', 'name' => 'Fire']
```

### orderBy()
*Returns a new Collection containing the items ordered by the especified column.*

orderBy(string  $column, string  $order = 'ASC') : \Amber\Collection\Base\Collection
``` php
$collection->push(['id' => '1', 'color' => 'red', 'name' => 'Fire']);
$collection->push(['id' => '2', 'color' => 'blue', 'name' => 'Sea']);
$collection->push(['id' => '3', 'color' => 'green', 'name' => 'Forest']);

$asc = $collection->orderBy('color');

$asc->all();
// returns [
    ['id' => '2', 'color' => 'blue', 'name' => 'Sea'],
    ['id' => '3', 'color' => 'green', 'name' => 'Forest'],
    ['id' => '1', 'color' => 'red', 'name' => 'Fire']
]

$desc = $collection->orderBy('color', 'desc'); // The $order param is not case sensitive.

$desc->all();
// returns [
    ['id' => '1', 'color' => 'red', 'name' => 'Fire'],
    ['id' => '3', 'color' => 'green', 'name' => 'Forest'],
    ['id' => '2', 'color' => 'blue', 'name' => 'Sea']   
]
```

### groupBy()
*Returns a new Collection grouped by the specified column.*

groupBy(string  $column) : \Amber\Collection\Base\Collection
``` php
$collection->push(['id' => '1', 'color' => 'red', 'name' => 'Fire']);
$collection->push(['id' => '2', 'color' => 'blue', 'name' => 'Sea']);
$collection->push(['id' => '3', 'color' => 'green', 'name' => 'Forest']);

$grouped = $collection->groupBy('color');

$grouped->all();
// returns [
    'red' => ['id' => '1', 'color' => 'red', 'name' => 'Fire'],
    'blue' => ['id' => '2', 'color' => 'blue', 'name' => 'Sea'],
    'green' => ['id' => '3', 'color' => 'green', 'name' => 'Forest']
]
```

### join()
*Returns a new Collection joined by the specified column.*

join(array  $array, string  $pkey, string  $fkey) : \Amber\Collection\Base\Collection

### sum()
*Calculates the sum of values in the collection.*

sum(string  $column = null) : integer
``` php
$collection->push(2);
$collection->push(5);
$collection->push(3);

$collection->sum(); // returns 10
```
Or you can sum a specific colum
```
$collection->push(['id' => 1, 'name' => 'red', 'quantity' => 2]);
$collection->push(['id' => 2, 'name' => 'blue', 'quantity' => 5]);
$collection->push(['id' => 3, 'name' => 'green', 'quantity' => 3]);

$collection->sum('quantity'); // returns 10
```

### firstOrNew()
*Gets the first item of the Collection or adds and returns a new one.*

firstOrNew(string  $key, mixed  $value) : mixed

### updateOrNew()
*Updates an item from the Collection or adds a new one.*

updateOrNew(string  $key, mixed  $value) : mixed
