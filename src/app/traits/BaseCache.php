<?php

namespace App\traits;

trait BaseCache
{
    /**
     * A key to use to distinguish a different cache key in the same business
     * @var string
     */
    public string $key;

    /**
     * @param $method
     * @return \ReflectionMethod
     * @throws \Exception
     */
    private function hasMethod($method): \ReflectionMethod
    {
        $reflection = new \ReflectionObject($this);
        foreach ($reflection->getMethods() as $m) {
            if (trim($m->getName(), '__') == $method) {
                return $m;
            }
        }
        throw new \Exception("Call to an undefined method:" . $method);
    }
}