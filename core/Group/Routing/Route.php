<?php
namespace core\Group\Routing;

use core\Group\Common\ArrayToolkit;
use core\Group\Container\Container;
use Exception;
Class Route
{
	protected $container;

	protected $action;

	protected $uri;

	protected $methods;

	protected $parameters;

	protected $parametersName;

	private static $_instance;

    	 /**
	 * Set the container instance on the route.
	 *
	 * @param  \core\Group\Container\Container  $container
	 * @return $this
	 */
 	public function setContainer(Container $container)
	{
		$this->container = $container;

		return $this;
	}

	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
	}

	public function getParametersName()
	{
		return $this->parametersName ;
	}

	public function setParametersName($parametersName)
	{
		$this->parametersName = $parametersName;
	}

	public function getParameters()
	{
		return $this->parameters ;
	}

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function getAction()
	{
		return $this->action ;
	}

	public function setUri($uri)
	{
		$this->uri = $uri;
	}

	public function getUri()
	{
		return $this->uri ;
	}

	public function setMethods($methods)
	{
		$this->methods = $methods;
	}

	public function getMethods()
	{
		return $this->methods ;
	}

	public static function getInstance(){

		if(!(self::$_instance instanceof self)){

			self::$_instance = new self;
		}

		return self::$_instance;
	}

}