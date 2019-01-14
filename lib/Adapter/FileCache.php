<?php

namespace Mention\Cache\Adapter;

use Mention\Cache\AbstractCache;

/**
 * File cache Adapter
 */
final class FileCache extends AbstractCache
{
    /**
     * The cache's folder mode.
     */
    const CACHE_FOLDER_MODE = 0755;
    
    /**
     * The default cache's folder name
     */
    const DEFAULT_CACHE_FOLDER_NAME = 'cache-mention';
    
    /**
     * @var string $cacheDirectory
     */
    private $cacheDirectory;
    
    /**
     * @param string|null $cacheDirectory The cache directory
     */
    public function __construct(?string $cacheDirectory = null)
    {
        $this->setCacheDirectory($cacheDirectory);
    }
    
    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        $this->validateKey($key);
        
        $filename = $this->cacheDirectory . DIRECTORY_SEPARATOR . $key;
    
        if (!file_exists($filename)) {
            return null;
        }
        
        return json_decode(file_get_contents($filename), true);
    }
    
    /**
     * {@inheritdoc}
     */
    public function set(string $key, $value): bool
    {
        $this->validateKey($key);
        
        return (bool) file_put_contents(
            $this->cacheDirectory . DIRECTORY_SEPARATOR . $key,
            json_encode($value)
        );
    }
    
    /**
     * If no directory path given, we use the default directory of temporary files
     *
     * @param null|string $cacheDirectory
     *
     * @return $this
     */
    private function setCacheDirectory(?string $cacheDirectory): self
    {
        $this->cacheDirectory = !$cacheDirectory
            ? sys_get_temp_dir() . DIRECTORY_SEPARATOR . self::DEFAULT_CACHE_FOLDER_NAME
            : $cacheDirectory;
        ;
    
        if (!file_exists($this->cacheDirectory)) {
            mkdir($this->cacheDirectory, self::CACHE_FOLDER_MODE, true);
        }
        
        return $this;
    }
}