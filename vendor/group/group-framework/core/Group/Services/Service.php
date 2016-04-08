<?php

namespace Group\Services;

class Service
{
    protected $serviceName;

	public function createDao($serviceName)
	{
		list($group, $serviceName) = explode(":", $serviceName);
		$class = $serviceName."DaoImpl";
		$this -> serviceName = "src\\Services\\".$group."\\Dao\\Impl\\".$class;

		return $this -> register();
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

        return \App::getInstance() -> singleton(strtolower($serviceName), function() use ($serviceName) {
            return new $serviceName();
        });
    }
}
