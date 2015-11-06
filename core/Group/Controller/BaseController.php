<?php
namespace core\Group\Controller;

use core\Group\Exceptions\NotFoundException;

abstract class BaseController
{
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

	abstract function render($tpl, $parameters);

	/**
	* route的实例
	*
	* @return core\Group\Routing\Route
	*/
	abstract function route();

	/**
	* 获取容器
	*
	* @return core\Group\Container\Container
	*/
	abstract function getContainer();

}