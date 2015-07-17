<?php
namespace core\Group\Routing;

Class Route
{
	protected $url;

	protected $parameters = [];

	protected $methods = ["GET", "PUT", "POST", "DELETE", "HEAD", "OPTIONS", "PATCH"];

	public function __construct()
	{
		
	}

	public function match()
	{
		$routing = include 'src/web/routing.php';
		$requestUri = $_SERVER['REQUEST_URI'];

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

		echo "404";

	}

	public  function run()
	{	
		return $this->match();
	}

	public function pregUrl($matches, $route_key, $routing) 
	{
		$route = $route_key;
		foreach ($matches[0] as $key => $match) {

			$regex = str_replace($match, "(\S+)", $route_key);
			$route_key = $regex;

			$regex = str_replace("/", "\/", $regex);

			$parameters[] = $match;
		}

		$this->setParameters($parameters);

		if (preg_match_all('/^'.$regex.'$/', $_SERVER['REQUEST_URI'], $values)) {
			
			$config = $routing[$route];
			$config['parameters'] = $this->mergeParameters($parameters, $values); 
			return  $config;
		}

		return false;
	}

	public function controller($config)
	{	
		$_controller = explode(':', $config['_controller']);

	            require_once 'src/'.$_controller[0].'/Controller/'.$_controller[1].'/'.$_controller[1].'Controller.php';

	            $className = $_controller[1].'Controller';

	            $class = new $className();

	            $action = $_controller[2].'Action';

		echo call_user_func_array(array($class, $action), isset($config['parameters']) ? $config['parameters'] : array());
          
	}

	public function mergeParameters($parameters, $values)
	{	
		foreach ($parameters as $key => $parameter) {
			
			$parameterValue[$parameter] = $values[$key+1][0]; 
		}

		return $parameterValue;
	}

	public function setParameters($parameters)
	{
		$this->parameters = $parameters;
	}

	public function getParameters()
	{
		return $this->parameters ;
	}
}