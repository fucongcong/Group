<?php
namespace core\Group\Dao;
use PDO;
use Config;

class Dao
{
	private static $_connection;

	protected $database_driver;

	protected $database_host;

	protected $database_name;

	protected $database_user;

	protected $database_password;

	public function __construct()
	{
		$pdo = Config::get('database::pdo');

		$this -> database_driver = $pdo['database_driver'];

		$this -> database_host = $pdo['database_host'];

		$this -> database_name = $pdo['database_name'];

		$this -> database_user = $pdo['database_user'];

		$this -> database_password = $pdo['database_password'];

	}

	public function getConnection()
	{
		if (self::$_connection) {

		    return self::$_connection;
		}

		$_connection = new PDO($this -> database_driver.":host=".$this -> database_host.";dbname=".$this -> database_name,$this -> database_user,$this -> database_password);

		self::$_connection = $_connection;

		return $_connection;
	}

}

?>