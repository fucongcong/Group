<?php

namespace core\Group\Cache;

class FileCache
{
    /**
     * FileCache的__call
     *
     * @param  method
     * @param  parameters
     * @return void
     */
    public static function __callStatic($method, $parameters)
    {
        $cache = \App::getInstance() -> singleton('localFileCache');

        if (!is_object($cache)) return;

        return call_user_func_array([$cache, $method], $parameters);
    }
}
