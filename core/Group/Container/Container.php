<?php
namespace core\Group\Container;

use ReflectionClass;
use Exception;
use core\Group\Exceptions\NotFoundException;
use core\Group\Contracts\Container\Container as ContainerContract;
use Config;

class Container implements ContainerContract
{
	private static $_instance;

    protected $timezone;

    protected $environment;


    public function init()
    {
        $this -> setTimezone();
        $this -> setEnvironment();
    }

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

    public function setTimezone()
    {
        $this -> timezone = Config::get('app::timezone');
        date_default_timezone_set($this -> getTimezone());
    }

    public function getTimezone()
    {
        return $this -> timezone;
    }

    public function getEnvironment()
    {
        return $this -> environment;
    }

    public function setEnvironment()
    {
        $this -> environment = Config::get('app::environment');
    }
}