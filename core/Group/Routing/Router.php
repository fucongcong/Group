<?php
namespace core\Group\Routing;

use core\Group\Common\ArrayToolkit;
use core\Group\Container\Container;
use Route;
use Exception;
use Cache;
use core\Group\Contracts\Routing\Router as RouterContract;

Class Router implements RouterContract
{
	protected $methods = ["GET", "PUT", "POST", "DELETE", "HEAD", "PATCH"];

	protected $route;

	protected $container;

	public function __construct()
	{

		$this->container = Container::getInstance();
	}
	/**
	* match the uri
	*
	* @return  void
	*/
	public function match()
	{
		$requestUri = $_SERVER['REQUEST_URI'];

		$this->setRoute($this->methods, $requestUri);
		$routing = $this->getRouting();

		if ($routing[$requestUri]) {

			return $this->controller($routing[$requestUri]);

		}

		foreach ($routing as $route_key => $route) {

			preg_match_all('/{(.*?)}/', $route_key, $matches);

			$config = "";

			if ($matches[0]) {

				$config = $this->pregUrl($matches, $route_key, $routing);
			}

			if ($config) {

				return $this->controller($config);
			}
		}

		$this->controller(array('_controller'=>"Web:Error:NotFound:index"));

	}

	public function run()
	{
		return $this->match();
	}


	/**
	* preg the url
	*
	* @param  matches
	* @param  route_key
	* @param  array routing
	* @return  array|bool false
	*/
	public function pregUrl($matches, $route_key, $routing)
	{
		$route = $route_key;
		foreach ($matches[0] as $key => $match) {

			$regex = str_replace($match, "(\S+)", $route_key);
			$route_key = $regex;

			$regex = str_replace("/", "\/", $regex);

			$parameters[] = $match;

		}

		foreach ($matches[1] as $key => $match) {

			$filterParameters[] = $match;

		}

		$this->route->setParametersName($filterParameters);

		if (preg_match_all('/^'.$regex.'$/', $_SERVER['REQUEST_URI'], $values)) {

			$config = $routing[$route];
			$config['parameters'] = $this->mergeParameters($filterParameters, $values);
			return  $config;
		}

		return false;
	}

	/**
	* do the controller
	*
	* @param  routing config
	* @return string
	*/
	public function controller($config)
	{
		$_controller = explode(':', $config['_controller']);

		$className = 'src\\'.$_controller[0].'\\Controller\\'.$_controller[1].'\\'.$_controller[2].'Controller';

		$action = $_controller[3].'Action';

		$this->route->setAction($action);

		$this->route->setParameters(isset($config['parameters']) ? $config['parameters'] : array());

        echo $this->container->doAction($className, $action, isset($config['parameters']) ? $config['parameters'] : array());

	}

	protected function mergeParameters($parameters, $values)
	{
		foreach ($parameters as $key => $parameter) {

			$parameterValue[$parameter] = $values[$key+1][0];
		}

		return $parameterValue;
	}
	//to do refactor me
	protected function getRouting()
	{
		$routing = include 'src/Web/routing.php';

		$routing = $this->checkMethods($routing);

		$routing =ArrayToolkit::index($routing, 'pattern');
		//cache #可以做cache层
		return $routing;
	}

	protected function checkMethods($routing)
	{
		if ($this -> container ->getEnvironment() == "prod") {

			return $this -> getMethodsCache($routing);
		}

		$config = $this -> createMethodsCache($routing);

		return $config;
	}

	/**
	 * set the route
	 *
	 * @param  methods
	 * @param  uri
	 */
	public function setRoute($methods, $uri)
	{
		$this->route = Route::getInstance();

		$this->route->setMethods($methods);
		$this->route->setUri($uri);

	}

	private function getMethodsCache($routing)
	{
		$file = 'route/routing_'.$_SERVER['REQUEST_METHOD'].'.php';

		if(Cache::isExist($file)) {

			return Cache::get($file);
		}

		$config = $this -> createMethodsCache($routing);

		Cache::set($file, $config);

		return $config;

	}

	private function createMethodsCache($routing)
	{
		$config = array();

		foreach ($routing as $key => $route) {

		       if(isset($route['methods']) && !in_array(strtoupper($route['methods']), $this->methods)) continue;

	                    if(isset($route['methods']) && $_SERVER['REQUEST_METHOD'] != strtoupper($route['methods']) ) continue;

	                    $config[$key] = $route;
		}

		return $config;
	}

}