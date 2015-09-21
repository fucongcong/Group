<?php
namespace core\Group\Dao;
use PDO;
use core\Group\Config\Config;
use core\Group\Dao\Driver\DB;

class Dao
{
	private static $_connection;

	protected $database_driver;

	protected $database_host;

	protected $database_name;

	protected $database_user;

	protected $database_password;

	protected $database_encoding;

	protected $driver;

	public function __construct()
	{
		$driver = Config::get('database::driver');

		$this -> driver = $driver;

		$database = Config::get("database::{$driver}");

		$this -> database_driver = $database['database_driver'];

		$this -> database_host = $database['database_host'];

		$this -> database_name = $database['database_name'];

		$this -> database_user = $database['database_user'];

		$this -> database_password = $database['database_password'];

		$this -> database_encoding = $database['database_encoding'];

	}

	public function getConnection()
	{
		if (self::$_connection) {

		    return self::$_connection;
		}

		switch ($this -> driver) {
			case 'DB':
				$_connection = new PDO($this -> database_driver.":host=".$this -> database_host.";dbname=".$this -> database_name,$this -> database_user,$this -> database_password);
				break;
			default:
				$_connection = new PDO($this -> database_driver.":host=".$this -> database_host.";dbname=".$this -> database_name,$this -> database_user,$this -> database_password);
				break;
		}

		self::$_connection = $_connection;

		return $_connection;
	}

}

?>