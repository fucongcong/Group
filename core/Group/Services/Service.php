<?php

namespace core\Group\Services;

use ServiceProvider;

class Service extends ServiceProvider
{
    protected $className;

    //to do 单列
	public function createDao($serviceName)
	{
		list($group, $serviceName) = explode(":", $serviceName);

		$class = $serviceName."DaoImpl";

		$className = "src\\Services\\".$group."\\Dao\\Impl\\".$class;

		return new $className;
	}

    //需要支持不同目录
    public function createService($serviceName)
    {
        list($group, $serviceName) = explode(":", $serviceName);

        $class = $serviceName."ServiceImpl";

        $this -> serviceName = "src\\Services\\".$group."\\Impl\\".$class;

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
