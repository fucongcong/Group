<?php
namespace core\Group\Contracts\Config;

interface Config
{
    /**
     * get config
     *
     * @param  configName,  name::key
     * @return string
     */
    public static function get($configName);

}
