# Simple Cart 

[![Build Status](https://travis-ci.org/levelfivehub/simplecart.svg)](https://travis-ci.org/levelfivehub/simplecart) [![Coverage Status](https://coveralls.io/repos/levelfivehub/simplecart/badge.svg?branch=develop&service=github)](https://coveralls.io/github/levelfivehub/simplecart?branch=develop)

This simple cart cannot get any simpler.

Initialise the cart with a name

```php
$simpleCart = new SimpleCart('test');
```

To add an item

```php
$item = [
    'name' => 'Red Balloon',
    'uniqueId' => 'RED001',
    'amount' => 10.99,
    'quantity' => '1',
    'currency' => 'GBP' // optional
];

$simpleCart->addItem($item);
```

To update an item

```php
$simpleCart->updateItem('RED001', 3);
```

To remove an item

```php
$simpleCart->removeItem('RED001');
```
