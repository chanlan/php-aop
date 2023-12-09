<?php

namespace App\logger;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerSingleton
{
    private static Logger $logger;

    private function __construct()
    {
    }

    public static function getLogger(...$params): Logger
    {
        if (!isset(self::$logger)) {
            self::$logger = new Logger($params[0]);
            self::$logger->pushHandler(new StreamHandler(isset($params[1]) ?: "F:\logs\php-aop.log", isset($params[2]) ?: Logger::INFO));
        }
        return self::$logger;
    }
}