<?php

namespace core\Group\Log;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Log
{
    protected static $levels = [
        'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ];

    protected static $cache_dir = "runtime/logs/";

    public static function debug($message, $context, $model = 'web.app')
    {
        return self::writeLog(__FUNCTION__, $message, $context, $model);
    }

    public static function info($message, $context, $model = 'web.app')
    {
        return self::writeLog(__FUNCTION__, $message, $context, $model);
    }

    public static function notice($message, $context, $model = 'web.app')
    {
        return self::writeLog(__FUNCTION__, $message, $context, $model);
    }

    public static function warning($message, $context, $model = 'web.app')
    {
        return self::writeLog(__FUNCTION__, $message, $context, $model);
    }

    public static function error($message, $context, $model = 'web.app')
    {
        return self::writeLog(__FUNCTION__, $message, $context, $model);
    }

    public static function critical($message, $context, $model = 'web.app')
    {
        return self::writeLog(__FUNCTION__, $message, $context, $model);
    }

    public static function alert($message, $context, $model = 'web.app')
    {
        return self::writeLog(__FUNCTION__, $message, $context, $model);
    }

    public static function emergency($message, $context, $model = 'web.app')
    {
        return self::writeLog(__FUNCTION__, $message, $context, $model);
    }

    public static function clear()
    {

    }

    public static function writeLog($level, $message, $context, $model)
    {
        $logger = new Logger($model);
        $env = \Container::getInstance() -> getEnvironment();

        $logger->pushHandler(new StreamHandler(static::$cache_dir.'/'.$env.'.log', self::$levels[$level]));
        $logger->pushHandler(new FirePHPHandler());

        return $logger->$level($message, $context);

    }
}
