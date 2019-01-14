<?php

namespace Mention\Cache\Adapter;

use Memcached as MemcachedServer;
use Mention\Cache\AbstractCache;

/**
 * MemCached Adapter
 */
final class MemCached extends AbstractCache
{
    /**
     * @var MemcachedServer $server
     */
    private $server;
    
    /**
     * @param MemcachedServer $server
     */
    public function __construct(MemcachedServer $server)
    {
        $this->server = $server;
    }
    
    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        $this->validateKey($key);
        
        $value = $this->server->get($key);
        if (MemcachedServer::RES_SUCCESS !== $this->server->getResultCode()) {
            return null;
        }
        
        return json_decode($value, true);
    }
    
    /**
     * {@inheritdoc}
     */
    public function set(string $key, $value): bool
    {
        $this->validateKey($key);
        
        return $this->server->set($key, json_encode($value));
    }
}