<?php
namespace src\web\controller;

use Twig_Loader_Filesystem;
use Twig_Environment;

class BaseController 
{

    public function __construct()
    {
        
    }   

    public function render($tpl,$array=array())
    {
        /*Twig_Autoloader::register();*/

        $loader = new Twig_Loader_Filesystem('src');
        $twig = new Twig_Environment($loader);

        return $twig->render($tpl,$array);
    } 

    public function createService($serviceName)
    {   
        $serviceName=explode(":", $serviceName);

        $class=$serviceName[1]."ServiceImpl";
        
        $className="src\\services\\".$serviceName[0]."\\Impl\\".$class;
        
        return new $className;
    }
}

?>