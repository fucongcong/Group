<?php

namespace core\Group\Services;

class Service
{
    //to do 单列
	public function createDao($serviceName)
	{
		$serviceName = explode(":", $serviceName);

		$class = $serviceName[1]."DaoImpl";

		$className = "src\\Services\\".$serviceName[0]."\\Dao\\Impl\\".$class;

		return new $className;
	}

    public function createService($serviceName)
    {
        return ServiceProvider::register($serviceName);
    }
}

?>