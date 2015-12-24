<?php

namespace Group\Session;

use Group\Services\ServiceMap;

class Session extends ServiceMap
{
    public static function getMap()
    {
        return 'session';
    }
}
