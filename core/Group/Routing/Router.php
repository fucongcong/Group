<?php

namespace core\Group\Routing;

use core\Group\Common\ArrayToolkit;
use core\Group\Contracts\Routing\Router as RouterContract;
use App;

Class Router implements RouterContract
{
	protected $methods = ["GET", "PUT", "POST", "DELETE", "HEAD", "PATCH"];

	protected $route;

	protected $container;

	public function __construct($container)
	{
		$this -> container = $container;
	}
	/**
	 * match the uri
	 *
	 * @return  void
	 */
	public function match()
	{
		$requestUri = $_SERVER['PATH_INFO'];

		$this -> setRoute($this->methods, $requestUri);
		$routing = $this -> getRouting();

		if (isset($routing[$requestUri])) {

			return $this -> controller($routing[$requestUri]);

		}

		foreach ($routing as $routeKey => $route) {

			preg_match_all('/{(.*?)}/', $routeKey, $matches);

			$config = "";

			if ($matches[0]) {

				$config = $this -> pregUrl($matches, $routeKey, $routing);
			}

			if ($config) {

				return $this -> controller($config);
			}
		}

		$this -> controller(array('controller'=>"Web:Error:NotFound:index"));
	}

	/**
	 * preg the url
	 *
	 * @param  matches
	 * @param  routeKey
	 * @param  array routing
	 * @return  array|bool false
	 */
	public function pregUrl($matches, $routeKey, $routing)
	{
        $countKey = explode("/", $_SERVER['PATH_INFO']);
        $countKeyPreg = explode("/", $routeKey);

        if(count($countKey)!= count($countKeyPreg)) {

            return false;
        }

		$route = $routeKey;
		foreach ($matches[0] as $key => $match) {

			$regex = str_replace($match, "(\S+)", $routeKey);
			$routeKey = $regex;

			$regex = str_replace("/", "\/", $regex);

			$parameters[] = $match;

		}

		foreach ($matches[1] as $key => $match) {

			$filterParameters[] = $match;

		}

		$this -> route -> setParametersName($filterParameters);

		if (preg_match_all('/^'.$regex.'$/', $_SERVER['PATH_INFO'], $values)) {

			$config = $routing[$route];
			$config['parameters'] = $this -> mergeParameters($filterParameters, $values);
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
		$controller = explode(':', $config['controller']);

		$className = 'src\\'.$controller[0].'\\Controller\\'.$controller[1].'\\'.$controller[2].'Controller';

		$action = $controller[3].'Action';

		$this -> route -> setAction($action);

		$this -> route -> setParameters(isset($config['parameters']) ? $config['parameters'] : array());

        echo $this -> container -> doAction($className, $action, isset($config['parameters']) ? $config['parameters'] : array());
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
		$routing = $this -> checkMethods();

		return $routing;
	}

	protected function checkMethods()
	{
		if ($this -> container -> getEnvironment() == "prod") {

			return $this -> getMethodsCache();
		}

		$config = $this -> createMethodsCache();

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
		$this -> route = \Route::getInstance();

		$this -> route -> setMethods($methods);
		$this -> route -> setCurrentMethod($_SERVER['REQUEST_METHOD']);
		$this -> route -> setUri($uri);
	}

	private function getMethodsCache()
	{
		$routing = include 'src/Web/routing.php';

		$file = 'route/routing_'.$_SERVER['REQUEST_METHOD'].'.php';

		if(\FileCache::isExist($file)) {

			return \FileCache::get($file);
		}

		$config = $this -> createMethodsCache($routing);

		\FileCache::set($file, $config);

		return $config;
	}

	private function createMethodsCache()
	{
		$routing = include 'src/Web/routing.php';

		$config = array();

		foreach ($routing as $key => $route) {

				if(!isset($route['methods'])) {

					$config[$key] = $route;
					continue;
				}

	       		if(isset($route['methods']) && !in_array(strtoupper($route['methods']), $this -> methods)) continue;

                if(isset($route['methods']) && $_SERVER['REQUEST_METHOD'] != strtoupper($route['methods']) ) continue;

                $config[$key] = $route;
		}

		$config = ArrayToolkit::index($config, 'pattern');

		return $config;
	}

}