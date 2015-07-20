<?php
namespace core\Group\Controller;

use Twig_Loader_Filesystem;
use Twig_Environment;
use core\Group\Twig\WebExtension;
use core\Group\Container\Container;
use core\Group\Controller\BaseController;

class Controller  extends BaseController
{	
	public function render($tpl,$array=array())
	{

		$loader = new Twig_Loader_Filesystem('src');

		$twig = new Twig_Environment($loader,array(
		 /*   'cache' =>'./cache/Temp'*/
		));

		$twig->addExtension(new WebExtension());
		return $twig->render($tpl,$array);
	} 

	public function createService($serviceName)
	{   
		$serviceName=explode(":", $serviceName);

		$class=$serviceName[1]."ServiceImpl";

		$className="src\\Services\\".$serviceName[0]."\\Impl\\".$class;

		return new $className;
	}

	public function getContainer()
	{
    		return Container::getInstance();
	}
}

?>