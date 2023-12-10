<?php

namespace App\traits;

use App\components\CacheComponent;
use App\cache\SimpleCache;
use App\aop\annotations\Cache;
use App\logger\LoggerSingleton;

trait CacheTrait
{
    use BaseCacheTrait;

    /**
     * @throws \Exception
     */
    public function __call($method, $parameters)
    {
        $method = $this->hasMethod($method);
        $annotations = $method->getAttributes(Cache::class);
        if (count($annotations) < 1) {
            return $method->invoke($this, ...$parameters);
        }
        foreach ($annotations as $annotation) {
            try {
                list($prefix) = $annotation->getArguments();
                return $this->doInvoke($method, $parameters, $prefix);
            } catch (\Exception $e) {
                LoggerSingleton::getLogger(static::class)->warning($e->getMessage());
            }
        }
    }

    /**
     * @throws \ReflectionException
     * @throws \Exception
     */
    private function doInvoke(\ReflectionMethod $method, array $parameters, string $prefix): mixed
    {
        $data = $method->invoke($this, ...$parameters);
        $cache = new CacheComponent($prefix, new SimpleCache());
        return match (true) {
            str_starts_with($method->getName(), '__add') => $cache->add($this->key, $data),
            str_starts_with($method->getName(), '__del') => $cache->delete($this->key),
            str_starts_with($method->getName(), '__update') => $cache->update($this->key, $data),
            default => throw new \Exception("not support cache operation [{$method->getName()}]")
        };
    }
}