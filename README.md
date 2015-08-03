Dspacelabs/Component/Cache [![Travis](https://img.shields.io/travis/dSpaceLabs/Cache.svg)](https://travis-ci.org/dSpaceLabs/Cache)
==========================

[![Packagist](https://img.shields.io/packagist/v/dspacelabs/cache.svg)](https://packagist.org/packages/dspacelabs/cache)
[![Packagist Pre Release](https://img.shields.io/packagist/vpre/dspacelabs/cache.svg)](https://packagist.org/packages/dspacelabs/cache)
[![Packagist](https://img.shields.io/packagist/l/dspacelabs/cache.svg)](https://packagist.org/packages/dspacelabs/cache)
[![Packagist](https://img.shields.io/packagist/dt/dspacelabs/cache.svg)](https://packagist.org/packages/dspacelabs/cache)

Generic Caching Library for PHP

## Installation

```
composer require dspacelabs/cache
```

Current Stable Release: [![Packagist](https://img.shields.io/packagist/v/dspacelabs/cache.svg)](https://packagist.org/packages/dspacelabs/cache)

Current Pre Release: [![Packagist Pre Release](https://img.shields.io/packagist/vpre/dspacelabs/cache.svg)](https://packagist.org/packages/dspacelabs/cache)

## Usage

```php
<?php

use Dspacelabs\Component\Cache\Adapter\ArrayAdapter;
use Dspacelabs\Component\Cache\CacheItemPool;

$pool = new CacheItemPool(new ArrayAdapter());

# General Usage
$item = $pool->getItem('sql.results');
if (!$item->isHit()) {
    $value = longRunningQuery();
    $item->set($value);
    $pool->save($item);
}
$results = $item->get();

# Delete items from cache
$sqlResults = $pool->getItem('sql.results');
$sqlResults->exists(); // returns true

$sqlResultsTwo = $pool->getItem('sql.results.two');
$sqlResultsTwo->exists(); // returns true

$pool->deleteItems(array('sql.results'));

$sqlResults->exists(); // returns false
$sqlResultsTwo->exists(); // returns true

# Clear entire cache
$sqlResults = $pool->getItem('sql.results');
$sqlResults->exists(); // returns true

$sqlResultsTwo = $pool->getItem('sql.results.two');
$sqlResultsTwo->exists(); // returns true

$pool->clear();

$sqlResults->exists(); // returns false
$sqlResultsTwo->exists(); // returns false

# Cached value expires after 3600 seconds
$item = $pool->getItem('sql.results');
$item->expiresAfter(3600);
$pool->save($item);
```

## Change Log

See [CHANGELOG.md].

## License

MIT

See [LICENSE].

[CHANGELOG.md]: CHANGELOG.md
[LICENSE]: LICENSE
