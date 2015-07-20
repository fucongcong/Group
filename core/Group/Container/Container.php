<?php
namespace core\Group\Container;

use ReflectionClass;
use Exception;
use core\Group\Exception\NotFoundException;

class Container
{
	private static $_instance;

	public function buildMoudle($class)
	{   
		if (!class_exists($class)) {

			throw new NotFoundException("Class ".$class." not found !");

		}

		$reflector = new ReflectionClass($class);

		return $reflector;
	}

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

	public static function getInstance(){

		if(!(self::$_instance instanceof self)){

			self::$_instance = new self;
		}

		return self::$_instance;
	}
}