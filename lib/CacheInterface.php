<?php

namespace Mention\Cache;

use Mention\Cache\Exception\InvalidArgumentException;

interface CacheInterface
{
    /**
     * Fetchs value from the code
     *
     * @param string $key The unique key of this item in the cache
     *
     * @return mixed The value of the item from the code
     *
     * @throws InvalidArgumentException
     */
    public function get(string $key);
    
    /**
     * Persists data in the cache
     *
     * @param string $key The key of the item to store
     * @param mixed $value The value of the item to store. Must be serializable
     *
     * @return bool True on success and false on failure
     *
     * @throws InvalidArgumentException
     */
    public function set(string $key, $value): bool;
}