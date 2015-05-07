<?php
namespace src\Services;
use PDO;
class BaseDao
{   
    private static $connection;


    public function getConnection()
    {   
        if (self::$connection) {

            return self::$connection;
        }

        $config=include("config.php");

        $connection = new PDO($config['database_driver'].":host=".$config['database_host'].";dbname=".$config['database_name'],$config['database_user'],$config['database_password']);

        self::$connection = $connection;

        return $connection; 
    }
}

?>