<?php
namespace core\Group\Dao;
use PDO;

class Dao
{
	private static $_connection;

	public function getConnection()
	{
		if (self::$_connection) {

		    return self::$_connection;
		}

		$config = include("config.php");

		$_connection = new PDO($config['database_driver'].":host=".$config['database_host'].";dbname=".$config['database_name'],$config['database_user'],$config['database_password']);

		self::$_connection = $_connection;

		return $_connection;
	}
}

?>