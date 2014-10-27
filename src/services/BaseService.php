<?php

class BaseService
{
    public function createDao($serviceName)
    {   
        $serviceName=explode(":", $serviceName);

        require_once("src/services/".$serviceName[0]."/Dao/Impl/".$serviceName[1]."DaoImpl.php");

        $class=$serviceName[1]."DaoImpl";
        
        return new $class;
    }
}

?>