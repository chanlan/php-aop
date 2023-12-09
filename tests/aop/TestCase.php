<?php

namespace Tests\aop;

use App\actions\UserAction;
use App\logger\LoggerSingleton;
use App\model\User;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function test_addUser()
    {

        LoggerSingleton::getLogger("demo")->info("a log test");
        $action = new UserAction();
        $user = new User();
        $user->setUserId(110221);
        $user->setUsername("demo");
        $rs = $action->addUser($user);
        $this->assertTrue(isset($rs), "add user is fail");
    }
}