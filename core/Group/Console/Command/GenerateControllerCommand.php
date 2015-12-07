<?php

namespace core\Group\Console\Command;

use core\Group\Console\Command as Command;
use Filesystem;

class GenerateControllerCommand extends Command
{
    public function init()
    {
        $input = $this -> getArgv();

        if (!isset($input[0])) {
            throw new \RuntimeException("名称不能为空！");
        }

        $name = $input[0];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            throw new \RuntimeException("名称只能为英文！");
        }

        $controllerName = ucfirst($name);
        $this -> outPut('开始初始化'.$controllerName.'Controller...');

        $dir = __ROOT__."src/Web";

        $this -> outPut('正在生成目录...');
        if (is_dir($dir."/Controller/".$controllerName)) {

            $this -> outPut('目录已存在...初始化失败');
            die;
        }

        $this -> filesystem = new Filesystem();
        $this -> filesystem -> mkdir($dir."/Controller/".$controllerName);
        $this -> filesystem -> mkdir($dir."/Views/".$controllerName);

        $this -> outPut('开始创建模板...');
        $data = $this -> getFile("Controller.tpl", $controllerName);
        file_put_contents ($dir."/Controller/".$controllerName."/".$controllerName."Controller.php", $data);

        $data = $this -> getFile("view.tpl", $controllerName);
        file_put_contents ($dir."/Views/".$controllerName."/"."index.html.twig", $data);

        $this -> outPut('初始化'.$controllerName.'Controller完成');
    }

    private function getFile($tpl, $controllerName)
    {
        $data = file_get_contents(__DIR__."/../tpl/{$tpl}");

        return $this -> getData($data, $controllerName);
    }

    private function getData($data, $controllerName)
    {
        return str_replace("{{name}}", $controllerName, $data);
    }
}
