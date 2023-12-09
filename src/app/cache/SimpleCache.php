<?php

namespace App\cache;

class SimpleCache implements Cache
{
    /**
     * a map to store data
     * @var array
     */
    private array $data = array();

    /**
     * get data from a map
     * @param $key
     * @return mixed
     */
    public function get($key): mixed
    {
        return $this->data[$key];
    }

    /**
     * store data to a map
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    public function set(string $key, mixed $value): bool
    {
        $this->data[$key] = $value;
        return true;
    }

    /**
     * delete value from a map
     * @param $key
     * @return bool
     */
    public function delete($key): bool
    {
        unset($this->data[$key]);
        return true;
    }
}