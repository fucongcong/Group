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
    public static function get($cacheName);

}
