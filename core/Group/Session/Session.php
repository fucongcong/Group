<?php

namespace core\Group\Session;

use core\Group\Services\ServiceMap;

class Session extends ServiceMap
{
    public static function getMap()
    {
        return 'session';
    }
}
