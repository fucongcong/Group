<?php
require_once 'vendor/twig/twig/lib/Twig/Autoloader.php';

class BaseController 
{

    public function __construct()
    {
        
    }   

    public function render($tpl,$array=array())
    {
        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem('src');
        $twig = new Twig_Environment($loader);

        return $twig->render($tpl,$array);
    } 

    public function createService($serviceName)
    {   
        $serviceName=explode(":", $serviceName);

        require_once("src/services/".$serviceName[0]."/Impl/".$serviceName[1]."ServiceImpl.php");

        $class=$serviceName[1]."ServiceImpl";
        
        return new $class;
    }
}

?>