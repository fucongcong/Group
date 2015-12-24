<?php

namespace Group\Cache;

class LocalFileCacheService
{
    protected static $cache_dir = "runtime/cache/";

    /**
     * 获取cache
     *
     * @param  cacheName,  name::key
     * @param  cache_dir
     * @return string|array
     */
    public function get($cacheName, $cache_dir = false)
    {
        $cache_dir = $cache_dir == false ? self::$cache_dir : $cache_dir;
        $dir = $cache_dir.$cacheName;

        return include $dir;
    }

    /**
     * 设置cache
     *
     * @param  cacheName(string)
     * @param  data(array)
     * @param  cache_dir(string)
     */
    public function set($cacheName, $data, $cache_dir = false)
    {
        $cache_dir = $cache_dir == false ? self::$cache_dir : $cache_dir;
        $dir = $cache_dir.$cacheName;

        $data = var_export($data, true);
        $data = "<?php
return ".$data.";";

        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach ($parts as $part) {

            if (!is_dir($dir .= "$part/")) {
                 mkdir($dir);
            }
        }

        file_put_contents("$dir/$file", $data);
    }

    /**
     * 文件是否存在
     *
     * @param  cacheName(string)
     * @param  cache_dir(string)
     * @return boolean
     */
    public function isExist($cacheName, $cache_dir = false)
    {
        $cache_dir = $cache_dir == false ? self::$cache_dir : $cache_dir;

        $dir = $cache_dir.$cacheName;

        return file_exists($dir);

    }
}
