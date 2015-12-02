<?php

namespace core\Group\Services;

use ServiceProvider;

class Service extends ServiceProvider
{
    private static $_instance;

    protected $className;

    //to do 单列
	public function createDao($serviceName)
	{
		$serviceName = explode(":", $serviceName);

		$class = $serviceName[1]."DaoImpl";

		$className = "src\\Services\\".$serviceName[0]."\\Dao\\Impl\\".$class;

		return new $className;
	}

    //需要支持不同目录
    public function createService($serviceName)
    {
        $serviceName = explode(":", $serviceName);

        $class = $serviceName[1]."ServiceImpl";

        $this -> serviceName = "src\\Services\\".$serviceName[0]."\\Impl\\".$class;

        return $this -> register();
    }

    public function register()
    {
        $serviceName = $this -> serviceName;

        return $this -> app -> singleton(strtolower($serviceName), function() use ($serviceName) {

            return new $serviceName($this -> app);

        });
    }
}

?>