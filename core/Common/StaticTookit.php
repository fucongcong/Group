<?php

namespace core\Common;

class StaticTookit{

    protected static $store = [];

    public static function set($key, $value, $canUnset = true) {
        if ($canUnset) {
            self::$store[0][$key] = $value;
        } else {
            self::$store[1][$key] = $value;
        }   
    }

    public static function get($key, $default = null) {

        if (isset(self::$store[0][$key])) return self::$store[0][$key];
        if (isset(self::$store[1][$key])) return self::$store[1][$key];
        return $default;
    }

    public static function unsetVar() {
        self::$store[0] = [];
    }
}
