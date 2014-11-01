<?php
namespace src\services;

class BaseService
{
    public function createDao($serviceName)
    {   
        $serviceName=explode(":", $serviceName);

        $class=$serviceName[1]."DaoImpl";
        
        $className="src\\services\\".$serviceName[0]."\\Dao\\Impl\\".$class;
        
        return new $className;
    }
}

?>