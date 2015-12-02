<?php

namespace core\Group\Cache;

use Exception;
use core\Group\Contracts\Cache\Cache as CacheContract;

class RedisCache implements CacheContract
{
    protected $redis;

    public function __construct($app)
    {
        $this -> redis = $app -> singleton('redis');
    }
    /**
     * 获取cache
     *
     * @param  cacheName
     * @return string|array
     */
    public function get($cacheName)
    {
        $this -> redis -> get($cacheName);
    }

    /**
     * 设置cache
     *
     * @param  cacheName(string); data(array); expireTime(int)
     */
    public function set($cacheName, $data, $expireTime = 3600)
    {
        $this -> redis -> set($cacheName, $data, $expireTime);
    }
}