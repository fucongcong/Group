<?php

namespace core\Group\Routing;

use core\Group\Common\ArrayToolkit;
use core\Group\Contracts\Routing\Router as RouterContract;
use App;

Class Router implements RouterContract
{
	/**
	 * 支持的http方法
	 *
	 * @var methods
	 */
	protected $methods = ["GET", "PUT", "POST", "DELETE", "HEAD", "PATCH"];

	/**
	 * Route object
	 *
	 * @var route
	 */
	protected $route;

	/**
	 * Container object
	 *
	 * @var container
	 */
	protected $container;

	/**
	 * 初始化
	 *
	 * @param Container container
	 * @param Request request
	 */
	public function __construct(\Container $container)
	{
		$this -> container = $container;

		$request = $this -> container -> getRequest();

		$this -> setRoute($this -> methods, $request -> getPathInfo(), $request -> getMethod());
	}

	/**
	 * match the uri
	 *
	 * @return  void
	 */
	public function match()
	{
		$requestUri = $this -> route -> getUri();

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

		return $this -> controller(array('controller'=>"Web:Error:NotFound:index"));		
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
        $countKey = explode("/", $this -> route -> getUri());
        $countKeyPreg = explode("/", $routeKey);

        if (count($countKey)!= count($countKeyPreg)) {

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

		if (preg_match_all('/^'.$regex.'$/', $this -> route -> getUri(), $values)) {

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
		list($group, $subGroup, $controller, $action) = explode(':', $config['controller']);

		$className = 'src\\'.$group.'\\Controller\\'.$subGroup.'\\'.$controller.'Controller';

		$action = $action.'Action';

		$this -> route -> setAction($action);

		$this -> route -> setParameters(isset($config['parameters']) ? $config['parameters'] : array());

        $response = $this -> container -> doAction($className, $action, isset($config['parameters']) ? $config['parameters'] : array(), $this -> container -> getRequest());

        $this -> container -> setResponse($response);
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
	public function setRoute($methods, $uri, $method)
	{
		$this -> route = \Route::getInstance();

		$this -> route -> setMethods($methods);
		$this -> route -> setCurrentMethod($method);
		$this -> route -> setUri($uri);
	}

	private function getMethodsCache()
	{
		$file = 'route/routing_'.$this -> route -> getCurrentMethod().'.php';

		if(\FileCache::isExist($file)) {

			return \FileCache::get($file);
		}

		$config = $this -> createMethodsCache();

		\FileCache::set($file, $config);

		return $config;
	}

	/**
	 * create routing cache
	 *
	 * @return  array
	 */
	private function createMethodsCache()
	{
		$routing = include 'src/Web/routing.php';

		$config = array();

		foreach ($routing as $key => $route) {

				$route['alias'] = $key;

				if(!isset($route['methods'])) {

					$config[$key] = $route;
					continue;
				}

	       		if(isset($route['methods']) && !in_array(strtoupper($route['methods']), $this -> methods)) continue;

                if(isset($route['methods']) && $this -> route -> getCurrentMethod() != strtoupper($route['methods']) ) continue;

                $config[$key] = $route;
		}

		$config = ArrayToolkit::index($config, 'pattern');

		return $config;
	}
}
