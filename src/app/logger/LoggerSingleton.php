<?php

namespace App\logger;

use Monolog\Logger;

class LoggerSingleton
{
    private static Logger $logger;

    private function __construct()
    {
    }

    public static function getLogger($name): Logger
    {
        if (!isset(self::$logger)) {
            self::$logger = new Logger($name);
        }
        return self::$logger;
    }
}