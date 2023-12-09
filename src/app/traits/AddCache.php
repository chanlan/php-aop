<?php

namespace App\traits;

use App\aop\annotations\Cache;
use App\cache\SimpleCache;
use App\components\CacheComponent;
use App\logger\LoggerSingleton;

trait AddCache
{
    use BaseCache;

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function __call($m, $parameters)
    {
        $method = $this->hasMethod($m);
        $annotations = $method->getAttributes(Cache::class);
        if (count($annotations) < 1) {
            return $method->invoke($this, ...$parameters);
        }
        foreach ($annotations as $annotation) {
            try {
                list($prefix) = $annotation->getArguments();
                $data = $method->invoke($this, ...$parameters);
                $cache = new CacheComponent($prefix, new SimpleCache());
                $cache->add($this->key, $data);
                return $data;
            } catch (\Exception $e) {
                LoggerSingleton::getLogger(static::class)->warning($e->getMessage());
            }
        }
    }
}