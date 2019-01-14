# Cache Mention

## Preamble 

This library is the result of the exercise from this gist : https://gist.github.com/arnaud-lb/bd39900db438ce543cb8

## Usage

```php
require 'vendor/autoload.php';

use Mention\Cache\Adapter\FileCache;

$cache = new FileCache();
$value = $cache->get('mention-key');

if (null === $value) {
    $value = 'Receive real-time information about your brand and competitors.'; 
    $cache->set('mention-key', $value);
}

echo $value;
```

## List of current Adapters

### &bull; FileCache

Stores values in local files. 

### &bull; MemCached

This adapter stores the values in-memory using one (or more) Memcached server instances.
Memcached PHP extension as well as a Memcached server must be installed, active, and running 
to use this adapter.




