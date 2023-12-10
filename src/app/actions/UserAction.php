<?php

namespace App\actions;

use App\aop\annotations\Cache;
use App\model\User;
use App\traits\CacheTrait;

class UserAction
{
    use CacheTrait;

    /**
     * add a user
     * @param User $user
     * @return mixed
     */
    #[Cache("__cache_user__")]
    public function __addUser__(User $user): User
    {
        $this->key = $user->getUserId();
        return $user;
    }

    /**
     * delete a user
     * @param string $userId
     * @return bool
     */
    #[Cache("__cache_user__")]
    public function __delUser__(string $userId): bool
    {
        $this->key = $userId;
        return true;
    }
}