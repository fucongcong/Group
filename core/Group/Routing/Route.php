<?php
namespace core\Group\Routing;

use core\Group\Common\ArrayToolkit;
use core\Group\Container\Container;
use Exception;
use core\Group\Contracts\Routing\Route as RouteContract;

Class Route implements RouteContract
{
	/**
	* container
	*
	* @var core\Group\Container\Container
	*/
	protected $container;

  	/**
	* action name
	*
	* @var string
	*/
	protected $action;

   	 /**
	* uri
	*
	* @var string
	*/
	protected $uri;

   	 /**
	* the methods current
	*
	* @var string
	*/
	protected $methods;

   	 /**
	* the parameters
	*
	* @var array
	*/
	protected $parameters;

   	 /**
	* the parametersName
	*
	* @var array
	*/
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

	/**
	* set params
	*
	* @param parameters
	*/
	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
	}

	/**
	* get params
	*
	* @return params name
	*/
	public function getParametersName()
	{
		return $this->parametersName ;
	}

	/**
	* set parametersName
	*
	* @param parameters name
	*/
	public function setParametersName($parametersName)
	{
		$this->parametersName = $parametersName;
	}

	/**
	* get parameters
	*
	* @return parameters
	*/
	public function getParameters()
	{
		return $this->parameters ;
	}

	/**
	* set action
	*
	* @param action
	*/
	public function setAction($action)
	{
		$this->action = $action;
	}

	/**
	* get action
	*
	* @return action
	*/
	public function getAction()
	{
		return $this->action ;
	}

	/**
	* set uri
	*
	* @param uri
	*/
	public function setUri($uri)
	{
		$this->uri = $uri;
	}

	/**
	* get uris
	*
	* @return uris
	*/
	public function getUri()
	{
		return $this->uri ;
	}

	/**
	* set methods
	*
	* @param methods
	*/
	public function setMethods($methods)
	{
		$this->methods = $methods;
	}

	/**
	* get methods
	*
	* @return methods
	*/
	public function getMethods()
	{
		return $this->methods ;
	}

	/**
	* return single class
	*
	* @return core\Group\Routing Route
	*/
	public static function getInstance(){

		if(!(self::$_instance instanceof self)){

			self::$_instance = new self;
		}

		return self::$_instance;
	}

}