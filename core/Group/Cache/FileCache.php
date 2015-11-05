<?php
namespace core\Group\Cache;

use Exception;
use core\Group\Contracts\Cache\Cache as CacheContract;

class FileCache implements CacheContract
{
    protected static $cache_dir = "runtime/cache/";

    /**
    * 获取cache
    *
    * @param  cacheName,  name::key
    * @return string|array
    */
    public static function get($cacheName)
    {
        $cache_dir = self::$cache_dir;
        $dir = $cache_dir.$cacheName;

        return include $dir;
    }

    public static function set($cacheName, $data)
    {
        $cache_dir = self::$cache_dir;
        $dir = $cache_dir.$cacheName;

        $data = var_export($data, true);
        $data = "<?php
        return ".$data.";";

        $parts = explode('/', $dir);
        $file = array_pop($parts);
        $dir = '';
        foreach($parts as $part) {

            if(!is_dir($dir .= "$part/")) {
                 mkdir($dir);
            }
        }

        file_put_contents("$dir/$file", $data);
    }

    public static function isExist($cacheName)
    {
        $cache_dir = self::$cache_dir;

        $dir = $cache_dir.$cacheName;

        return file_exists($dir);

    }
}