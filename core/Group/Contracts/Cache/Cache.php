<?php

namespace core\Group\Contracts\Cache;

interface Cache
{
    /**
     * 获取cache
     *
     * @param  cacheName,  name::key
     * @return string|array
     */
    public function get($cacheName);

    /**
     * 设置cache
     *
     * @param  cacheName(string); data(array); param(参数)
     */
    public function set($cacheName, $data, $param);

}
