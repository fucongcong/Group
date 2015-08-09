<?php
namespace core\Group\Container;

use ReflectionClass;
use Exception;
use core\Group\Exceptions\NotFoundException;
use core\Group\Contracts\Container\Container as ContainerContract;

class Container implements ContainerContract
{
	private static $_instance;

	/**
	 * build a moudle class
	 *
	 * @param  class
	 * @return ReflectionClass class
	 */
	public function buildMoudle($class)
	{
		if (!class_exists($class)) {

			throw new NotFoundException("Class ".$class." not found !");

		}

		$reflector = new ReflectionClass($class);

		return $reflector;
	}

    /**
     * do the moudle class action
     *
     * @param  class
     * @param  action
     * @param  array parameters
     * @return string
     */
	public function doAction($class, $action, array $parameters = [])
	{
		$reflector = $this->buildMoudle($class);
		if(!$reflector->hasMethod($action)) {

			throw new NotFoundException("Class ".$class." exist ,But the Action ".$action." not found");
		}

		$instanc =$reflector->newInstanceArgs();
		$method = $reflector->getmethod($action);
		return $method->invokeArgs($instanc, $parameters);

	}

    /**
     * return single class
     *
     * @return core\Group\Container Container
     */
	public static function getInstance(){

		if(!(self::$_instance instanceof self)){

			self::$_instance = new self;
		}

		return self::$_instance;
	}
}