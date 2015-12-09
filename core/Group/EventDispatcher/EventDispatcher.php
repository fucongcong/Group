<?php

namespace core\Group\EventDispatcher;

use core\Group\Services\ServiceMap;

class EventDispatcher extends ServiceMap
{
    public static function getMap()
    {
        return 'eventDispatcher';
    }
}
