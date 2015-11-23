<?php

namespace core\Group\Services;

use NotFoundException;

class ServiceProvider
{
    public static function register($serviceName)
    {
        $serviceName = explode(":", $serviceName);

        $class = $serviceName[1]."ServiceImpl";

        $className = "src\\Services\\".$serviceName[0]."\\Impl\\".$class;

        return new $className;

    }
}
