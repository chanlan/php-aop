<?php

namespace Tests\aop;

use App\actions\UserAction;
use App\model\User;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function test_addUser()
    {
        $action = new UserAction();
        $user = new User();
        $user->setUserId(110221);
        $user->setUsername("demo");
        $rs = $action->addUser($user);
        $this->assertTrue(isset($rs), "add user is fail");
    }
}