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

    /**
     * 设置cache
     *
     * @param  cacheName(string); data(array); expireTime(int)
     */
    public static function set($cacheName, $data, $expireTime = 3600)
    {

    }

}