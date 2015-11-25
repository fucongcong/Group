<?php
namespace core\Group\Dao;
use Aura\Sql\ExtendedPdo;
use Aura\Sql\ConnectionLocator;
use Config;

class Dao
{
	protected $config;

	private static $_connection;

	public function __construct()
	{
		$pdo = Config::get('database::pdo');

		$this -> config = $pdo;
	}

	public function getConnection()
	{
		if (self::$_connection) {

		    return self::$_connection;
		}

		$_connection = $this -> getConnectionLocator();

		self::$_connection = $_connection;

		return $_connection;
	}

	public function getDefault()
	{
		return $this -> getConnection() -> getDefault();
	}

	public function getRead($name = null)
	{
		return $this -> getConnection() -> getRead($name);
	}

	public function getWrite($name = null)
	{
		return $this -> getConnection() -> getWrite($name);
	}

	private function getConnectionLocator()
	{
		$config = $this -> config;
		$connections = new ConnectionLocator;

		if(isset($config['default'])) {

			$connections -> setDefault(function () use ($config) {
			    return new ExtendedPdo(
						$config['default']['database_driver'].':host='.$config['default']['database_host'].';dbname='.$config['default']['database_name'],
				        $config['default']['database_user'],
				        $config['default']['database_password']
				);
			});
		}

		if(isset($config['write'])) {

			foreach ($config['write'] as $name => $db) {
				$connections -> setWrite($name, function () use ($db) {
				    return new ExtendedPdo(
				        $db['database_driver'].':host='.$db['database_host'].';dbname='.$db['database_name'],
				        $db['database_user'],
				        $db['database_password']
				    );
				});
			}
		}

		if(isset($config['read'])) {

			foreach ($config['read'] as $name => $db) {
				$connections -> setRead($name, function () use ($db) {
				    return new ExtendedPdo(
				        $db['database_driver'].':host='.$db['database_host'].';dbname='.$db['database_name'],
				        $db['database_user'],
				        $db['database_password']
				    );
				});
			}
		}

		return $connections;
	}

}

?>