<?php

namespace core\Group\Cache;

use core\Group\Services\ServiceMap;

class FileCache extends ServiceMap
{
    public static function getMap()
    {
        return 'localFileCache';
    }
}
