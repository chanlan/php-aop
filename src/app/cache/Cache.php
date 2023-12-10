<?php

namespace App\cache;

interface Cache
{
    public function get($key): mixed;

    public function set(string $key, mixed $value): mixed;

    public function delete($key): bool;
}