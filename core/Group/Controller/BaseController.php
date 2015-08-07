<?php
namespace core\Group\Controller;

use core\Group\Exceptions\NotFoundException;
use core\Group\Routing\Route;

abstract class BaseController
{
	protected static $route;

	/**
	 * 在控制类下执行方法
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

	/**
	* route的单例
	*
	* @return core\Group\Routing\Route
	*/
	public static function route()
	{
		if(!(self::$route instanceof Route)){

			self::$route = Route::getInstance();
		}

		return self::$route;
	}

}