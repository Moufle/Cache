<?php

namespace Mention\Cache;

use Mention\Cache\Exception\InvalidArgumentException;

abstract class AbstractCache implements CacheInterface
{
    /**
     * Validate the key
     *
     * @param string $key
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    protected function validateKey(string $key): void
    {
        if (preg_match('/[\/\\\\]+/', $key) || empty($key)) {
            throw new InvalidArgumentException("Invalid key '$key'");
        }
    }
}