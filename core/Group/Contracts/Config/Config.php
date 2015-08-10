<?php
namespace core\Group\Contracts\Config;

interface Config
{
    /**
    * 获取config下得值
    *
    * @param  configName,  name::key
    * @return string
    */
    public static function get($configName);

    /**
    * 设置config
    *
    * @param  array config
    */
    public function setConfig($config);

    /**
    * 获取config
    *
    * @return array
    */
    public function getConfig();

}
