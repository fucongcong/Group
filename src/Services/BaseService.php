<?php
namespace src\Services;

class BaseService
{
    public function createDao($serviceName)
    {   
        $serviceName=explode(":", $serviceName);

        $class=$serviceName[1]."DaoImpl";
        
        $className="src\\Services\\".$serviceName[0]."\\Dao\\Impl\\".$class;
        
        return new $className;
    }
}

?>