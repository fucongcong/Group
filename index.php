<?php

$rounting=include("src/web/routing.php");

$loader = require __DIR__.'/vendor/autoload.php';

$loader->setUseIncludePath(true);

if($rounting[$_SERVER['REQUEST_URI']]){

    $rount=$rounting[$_SERVER['REQUEST_URI']];

    $rount=explode(":", $rount);
   
    require_once("src/".$rount[0]."/controller/".$rount[1]."/".$rount[1]."Controller.php");

    $className=$rount[1]."Controller";

    $class=new $className();

    $action=$rount[2]."Action";
   
    echo $class->$action();

}else{
    echo "404页面不存在";
}

?>