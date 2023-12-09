<?php

namespace App\actions;

use App\aop\annotations\Cache;
use App\model\User;
use App\traits\AddCache;

class UserAction
{
    use AddCache;

    /**
     * @param User $user
     * @return mixed
     */
    #[Cache("__cache_user__")]
    public function __addUser__(User $user): User
    {
        $this->key = $user->getUserId();
        return $user;
    }
}