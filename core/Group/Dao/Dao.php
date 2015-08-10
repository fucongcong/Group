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
		$this -> database_driver = Config::get('database::database_driver');

		$this -> database_host = Config::get('database::database_host');

		$this -> database_name = Config::get('database::database_name');

		$this -> database_user = Config::get('database::database_user');

		$this -> database_password = Config::get('database::database_password');

	}

	public function getConnection()
	{
		if (self::$_connection) {

		    return self::$_connection;
		}

		$config = include("config.php");

		$_connection = new PDO($this -> database_driver.":host=".$this -> database_host.";dbname=".$this -> database_name,$this -> database_user,$this -> database_password);

		self::$_connection = $_connection;

		return $_connection;
	}

}

?>