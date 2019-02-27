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

$collection = new Collection();
```

## Available methods
### has() - *Whether an item is present it the collection.*
has(string  $key) : boolean
``` php
$array = ['key' => 'value'];

$collection = new Collection($array);

$collection->has('key'); // returns true.

$collection->has('anotherKey'); // returns false.
```

### contains() - *Alias for has().*
contains(string  $key) : boolean

### hasNot() - *Whether an item is not present it the collection.*
hasNot(string  $key) : boolean
``` php
$array = ['key' => 'value'];

$collection = new Collection($array);

$collection->hasNot('key'); // returns false.

$collection->hasNot('anotherKey'); // returns true.
```

### set() - *Sets or updates an item in the collection.*
set(string  $key, mixed  $value) : void
``` php
$collection = new Collection();

$collection->set('key', 'value');

$collection->has('key'); // returns true.
```

### put() - *Alias for put().*
put(string  $key, mixed  $value) : void

### add() - *Sets a new item to the collection.*
add(string  $key, mixed  $value) : boolean
``` php
$collection = new Collection();

$collection->add('key', 'value'); // returns true.

$collection->add('key', 'value'); // returns false, since the item already is in the collection.
```

### insert() - *Alias for add().*
insert(string  $key, mixed  $value) : boolean


### update() - *Updates an existent item in the collection.*
update(string  $key, mixed  $value) : boolean
``` php
$collection = new Collection();

$collection->update('key', 'value'); // returns false, since the item doesn't exists in the collecction

$collection->set('key', 'value');

$collection->update('key', 'value'); // returns true.
```

### push() - *Sets a new item at the end of the collection.*
push(mixed  $value) : void
``` php
$collection = new Collection();

$collection->push('value1');
$collection->push('value2');
$collection->push('value3');

$collection->all(); // returns ['value1', 'value2', 'value3']
```

### pushTo() - *Push a new item at the end of a item in the collection.*
pushTo(string  $key, mixed  $value) : boolean

### get() - *Gets an item from collection.*
get(string  $key) : mixed|void

### find() - *Alias for get.*
find(string  $key) : mixed

### first() - *Returns the first element of the collection.*
first() : mixed

### last() - *Returns the last element of the collection.*
last() : mixed

### remove() - *Deletes and retrives an item from collection.*
remove(string  $key) : mixed

### delete() - *Deletes an item from collection.*
delete(string  $key) : boolean

### map() - *Iterates through the collection and passes each value to the given callback.*
map(\Closure  $callback) : \Amber\Collection\Base\Collection

### filter() - *Returns a new filtered collection using a user-defined function.*
filter(\Closure  $callback) : \Amber\Collection\Base\Collection

### sort() - *Returns a new sorted collection using a user-defined comparison function.*
sort(\Closure  $callback) : \Amber\Collection\Base\Collection

### reverse() - *Returns a new reversed collection.*
reverse() : \Amber\Collection\Base\Collection

### merge() - *Returns a new collection merged with one or more arrays.*
merge(array  $array) : \Amber\Collection\Base\Collection

### chunk() - *Splits an array into chunks.*
chunk(integer  $size, boolean  $preserve_keys = false) : \Amber\Collection\Base\Collection

### column() - *Returns the values from a single column.*
column(string  $column) : \Amber\Collection\Base\Collection

### flip() - *Exchanges all keys with their associated values.*
flip() : \Amber\Collection\Base\Collection

### setMultiple() - *Sets or updates an array of items in the collection, and returns true on success.*
setMultiple(array  $array) : void

### getMultiple()  - *Gets multiple items from the collection.*
getMultiple(array  $array) : mixed

### hasMultiple() - *Whether multiple items are present in the collection.*
hasMultiple(array  $array) : boolean

### select() - *Returns a new Collection containing the items in the specified column(s).*
select(array|string  $columns) : \Amber\Collection\Base\Collection

### where() - *Returns a new Collection containing the items in the specified column that are equal to the especified value.*
where(string  $column, mixed  $value) : \Amber\Collection\Base\Collection

### whereNot() - *Returns a new Collection containing the items in the specified column that are not equal to the especified value.*
whereNot(string  $column, mixed  $value) : \Amber\Collection\Base\Collection

### whereIn() - *Returns a new Collection containing the items in the specified column that are equal to the especified value(s).*
whereIn(string  $column, array  $values = array()) : \Amber\Collection\Base\Collection

### whereNotIn() - *Returns a new Collection containing the items in the specified column that are not equal to the especified value(s).*
whereNotIn(string  $column, array  $values = array()) : \Amber\Collection\Base\Collection

### orderBy() - *Returns a new Collection containing the items ordered by the especified column.*
orderBy(string  $column, string  $order = 'ASC') : \Amber\Collection\Base\Collection

### groupBy() - *Returns a new Collection grouped by the specified column.*
groupBy(string  $column) : \Amber\Collection\Base\Collection

### join() - *Returns a new Collection joined by the specified column.*
join(array  $array, string  $pkey, string  $fkey) : \Amber\Collection\Base\Collection

### sum() - *Calculates the sum of values in the collection.*
sum(string  $column = null) : integer

### firstOrNew() - *Gets the first item of the Collection or adds and returns a new one.*
firstOrNew(string  $key, mixed  $value) : mixed

### updateOrNew() - *Updates an item from the Collection or adds a new one.*
updateOrNew(string  $key, mixed  $value) : mixed
