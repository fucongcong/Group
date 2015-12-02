<?php

namespace core\Group\Cache;

use Exception;

class Cache
{
    public static function redis()
    {
        return \App::getInstance() -> singleton('redisCache');
    }

    public static function __callStatic($method, $parameters)
    {
        if(\Config::get("database::cache") != 'redis') return;

        $cache = \App::getInstance() -> singleton('redisCache');

        if(!is_object($cache)) return;

        return call_user_func_array([$cache, $method], $parameters);
    }
}