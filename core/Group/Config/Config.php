<?php
namespace core\Group\Config;

use Exception;
use core\Group\Contracts\Config\Config as ConfigContract;

Class Config implements ConfigContract
{
    /**
    * get config
    *
    * @param  configName,  name::key
    * @return string|array
    */
    public static function get($configName)
    {
        $configName = explode('::', $configName);

        if (count($configName) < 1) {

            return array();

        }

        $config = require_once("config/".$configName[0].".php");

        if (count($configName) >= 2) {

            return $config[$configName[1]];

        }

        return $config;

    }

}