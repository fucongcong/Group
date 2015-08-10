<?php
namespace core\Group\Config;

use Exception;
use core\Group\Contracts\Config\Config as ConfigContract;

class Config implements ConfigContract
{
    private static $_instance;

    protected $config = [];

    public static function get($configName)
    {
        return  static::getInstance() -> read($configName);
    }

    /**
    * read config
    *
    * @param  configName,  name::key
    * @return string|array
    */
    public function read($configName)
    {
        $configName = explode('::', $configName);

        if (count($configName) == 2) {

            $config = $this -> checkConfig($configName[0], $configName[1]);

            return $config[$configName[1]];

        }

        return array();

    }

    public function setConfig($config)
    {
        $this -> config = array_merge($this -> config, $config);
    }

    public function getConfig()
    {
        return $this -> config;
    }

    /**
    * return single class
    *
    * @return core\Group\Config Config
    */
    public static function getInstance(){

        if(!(self::$_instance instanceof self)){

            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function checkConfig($key, $value)
    {
        $config = $this -> config;

        if (!isset($config[$key])) {

            $app = require("config/".$key.".php");

            $this -> config = array_merge($this -> config, $app);

        }

        return $this -> config;
    }

}