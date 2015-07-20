<?php
namespace core\Group\Services;

class Service
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