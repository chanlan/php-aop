<?php

namespace App\aop\annotations;

#[\Attribute(\Attribute::TARGET_FUNCTION | \Attribute::TARGET_METHOD)]
class Cache
{
    public string $businessKey;

    public function __construct(string $businessKey)
    {
        $this->businessKey = $businessKey;
    }
}