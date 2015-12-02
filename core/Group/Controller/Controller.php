<?php

namespace core\Group\Controller;

use Twig_Loader_Filesystem;
use Twig_Environment;
use core\Group\Twig\WebExtension;
use core\Group\Contracts\Controller\Controller as ControllerContract;
use core\Group\Exceptions\NotFoundException;
use Service;
use Response;

class Controller implements ControllerContract
{
	protected $app;

	public function __construct($app)
	{
		$this -> app = $app;
	}

	/**
	 * 渲染模板的方法
	 *
	 * @param  string  $tpl
	 * @param  array   $array
	 * @return response
	 */
	public function render($tpl, $array = array())
	{

		$loader = new Twig_Loader_Filesystem(\Config::get('view::path'));

		if (\Config::get('view::cache')) {

			$env = array(
		    	'cache' => Config::get('view::cache_dir')
			);
		}

		$twig = new Twig_Environment($loader, isset($env) ? $env : array());

		$twig -> addExtension(new WebExtension());
		return new Response($twig -> render($tpl, $array));
	}

	/**
	 * 实例化一个服务类
	 *
	 * @param  string  $serviceName
	 * @return class
	 */
	public function createService($serviceName)
	{
		$service = new Service($this -> app);
		return $service -> createService($serviceName);
	}

	/**
	 * route的实例
	 *
	 * @return core\Group\Routing\Route
	 */
	public function route()
	{
		return $this -> app -> singleton('route');
	}

	/**
	 * 获取容器
	 *
	 * @return core\Group\Container\Container
	 */
	public function getContainer()
	{
		return $this -> app -> singleton('container');
	}

	public function __call($method, $parameters)
	{
		throw new NotFoundException("Method [$method] does not exist.");
	}
}

?>