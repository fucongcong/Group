<?php
namespace src\services;
use PDO;
class BaseDao
{   
    public function getConnection()
    {   
        $config=include("config.php");

        return new PDO($config['database_driver'].":host=".$config['database_host'].";dbname=".$config['database_name'],$config['database_user'],$config['database_password']); 
    }
}

?>