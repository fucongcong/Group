<?php
namespace core\Group\Controller;

use core\Group\Exceptions\NotFoundException;
use core\Group\Routing\Route;

abstract class BaseController
{
	protected static $route;

	/**
	 * Execute an action on the controller.
	 *
	 * @param  string  $method
	 * @param  array   $parameters
	 * @return response
	 */
	public function callAction($method, $parameters)
	{
    		return call_user_func_array([$this, $method], $parameters);
	}

	public function __call($method, $parameters)
	{
		throw new NotFoundException("Method [$method] does not exist.");
	}

	public static function route()
	{
		if(!(self::$route instanceof Route)){

			self::$route = Route::getInstance();
		}

		return self::$route;
	}

}