Dspacelabs/Component/Cache
==========================

Generic Caching Library for PHP

## Installation

```
composer require dspacelabs/cache
```

## Usage

```php
<?php

use Dspacelabs\Component\Cache\Adapter\ArrayAdapter;
use Dspacelabs\Component\Cache\CacheItemPool;

$pool = new CacheItemPool(new ArrayAdapter());

# some value that needs to be cached
$item = $pool->getItem('sql.result.long_running');
$item->set($resultFromQuery);

# Save result in cache
$pool->saveItem($item);

# retrieve item from pool
$item = $pool->getItem('sql.result.long_running');
$resultFromQuery = $item->get();
```

## Change Log

## License

MIT
