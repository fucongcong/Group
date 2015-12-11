<?php

namespace core\Group\Console\Command;

use core\Group\Console\Command as Command;
use Filesystem;

class GenerateServiceCommand extends Command
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

        $serviceName = ucfirst($name);
        $this -> outPut('开始初始化'.$serviceName.'Service...');

        $dir = __ROOT__."src/Services";

        $this -> outPut('正在生成目录...');

        if (is_dir($dir."/".$serviceName)) {

            $this -> outPut('目录已存在...初始化失败');
            die;
        }

        $this -> filesystem = new Filesystem();
        $this -> filesystem -> mkdir($dir."/".$serviceName."/Dao");
        $this -> filesystem -> mkdir($dir."/".$serviceName."/Dao/Impl");
        $this -> filesystem -> mkdir($dir."/".$serviceName."/Impl");
        $this -> filesystem -> mkdir($dir."/".$serviceName."/Rely");

        $this -> outPut('开始创建模板...');
        $data = $this -> getFile("Service.tpl", $serviceName);
        file_put_contents ($dir."/".$serviceName."/".$serviceName."Service.php", $data);

        $data = $this -> getFile("ServiceImpl.tpl", $serviceName);
        file_put_contents ($dir."/".$serviceName."/Impl/".$serviceName."ServiceImpl.php", $data);

        $data = $this -> getFile("ServiceImpl.tpl", $serviceName);
        file_put_contents ($dir."/".$serviceName."/Impl/".$serviceName."ServiceImpl.php", $data);

        $data = $this -> getFile("BaseService.tpl", $serviceName);
        file_put_contents ($dir."/".$serviceName."/Rely/".$serviceName."BaseService.php", $data);

        $data = $this -> getFile("Dao.tpl", $serviceName);
        file_put_contents ($dir."/".$serviceName."/Dao/".$serviceName."Dao.php", $data);

        $data = $this -> getFile("DaoImpl.tpl", $serviceName);
        file_put_contents ($dir."/".$serviceName."/Dao/Impl/".$serviceName."DaoImpl.php", $data);

        $this -> outPut('初始化'.$serviceName.'Service完成');
    }

    private function getFile($tpl, $serviceName)
    {
        $data = file_get_contents(__DIR__."/../tpl/{$tpl}");

        return $this -> getData($data, $serviceName);
    }

    private function getData($data, $serviceName)
    {
        return str_replace("{{name}}", $serviceName, $data);
    }
}
