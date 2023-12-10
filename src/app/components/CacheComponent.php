<?php

namespace App\components;

use App\cache\Cache;

class CacheComponent
{
    /**
     * A flag to use to distinguish a different business
     * @var string
     */
    public string $prefix;
    /**
     * a cache implement instance object
     * @var Cache
     */
    private Cache $instance;

    /**
     * @param string $prefix
     * @param Cache $instance
     */
    public function __construct(string $prefix, Cache $instance)
    {
        $this->prefix = $prefix;
        $this->instance = $instance;
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function add($key, $value): mixed
    {
        return $this->instance->set($this->prefix . $key, $value);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key): mixed
    {
        return $this->instance->get($this->prefix.$key);
    }

    /**
     * @param $key
     * @return bool
     */
    public function delete($key): bool
    {
        return $this->instance->delete($this->prefix.$key);
    }
}