<?php
namespace vender\Group;

Class Kernal 
{
    public function init() 
    {
        $rounting=include("src/web/routing.php");

        if($rounting[$_SERVER['REQUEST_URI']]){

            $rount=$rounting[$_SERVER['REQUEST_URI']];

            $rount=explode(":", $rount);
           
            require_once("src/".$rount[0]."/Controller/".$rount[1]."/".$rount[1]."Controller.php");

            $className=$rount[1]."Controller";

            $class=new $className();

            $action=$rount[2]."Action";
           
            echo $class->$action();

        }else{
            echo "404页面不存在";
        }
    }
}