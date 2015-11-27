<?php

namespace core\Group\Cache;

use Exception;
use core\Group\Contracts\Cache\Cache as CacheContract;

class Cache implements CacheContract
{
    /**
    * 获取cache
    *
    * @param  cacheName
    * @return string|array
    */
    public static function get($cacheName)
    {

    }

    public static function set($cacheName, $data, $expireTime)
    {

    }

}