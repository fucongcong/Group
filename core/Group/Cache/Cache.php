<?php

namespace core\Group\Cache;

class Cache
{
    /**
     * 返回一个rediscache的对象
     *
     * @return object
     */
    public static function redis()
    {
        return \App::getInstance() -> singleton('redisCache');
    }

    /**
     * cache的__call
     *
     * @param  method
     * @param  parameters
     * @return void
     */
    public static function __callStatic($method, $parameters)
    {
        if (\Config::get("database::cache") != 'redis') return;

        $cache = \App::getInstance() -> singleton('redisCache');

        if (!is_object($cache)) return;

        return call_user_func_array([$cache, $method], $parameters);
    }
}