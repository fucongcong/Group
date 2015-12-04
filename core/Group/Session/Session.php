<?php

namespace core\Group\Session;

class Session
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
        $session = \App::getInstance() -> singleton('session');

        if (!is_object($session)) return;

        return call_user_func_array([$session, $method], $parameters);
    }
}