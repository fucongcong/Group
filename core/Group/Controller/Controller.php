<?php
namespace core\Group\Controller;

use Twig_Loader_Filesystem;
use Twig_Environment;
use core\Group\Twig\WebExtension;
use core\Group\Controller\BaseController;
use Config;
use Route;
use Container;
use ServiceProvider;

class Controller  extends BaseController
{
	/**
	* 渲染模板的方法
	*
	* @param  string  $tpl
	* @param  array   $array
	* @return response
	*/
	public function render($tpl,$array=array())
	{

		$loader = new Twig_Loader_Filesystem(Config::get('view::path'));

		if (Config::get('view::cache')) {

			$env =  array(
		    	'cache' =>Config::get('view::cache_dir')
			);
		}

		$twig = new Twig_Environment($loader, isset($env) ? $env : array());

		$twig->addExtension(new WebExtension());
		return $twig->render($tpl,$array);
	}

	/**
	* 实例化一个服务类
	*
	* @param  string  $serviceName
	* @return class
	*/
	//to do 单列 可以扩展为模块
	public function createService($serviceName)
	{
		return ServiceProvider::register($serviceName);
	}

	/**
	* route的实例
	*
	* @return core\Group\Routing\Route
	*/
	public function route()
	{
		return Route::getInstance();
	}

	/**
	* 获取容器
	*
	* @return core\Group\Container\Container
	*/
	public function getContainer()
	{
		return Container::getInstance();
	}
}

?>