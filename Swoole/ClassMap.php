<?php
namespace Swoole;
Class ClassMap
{
    private $dir = array('core','src/Services');

    public  function doSearch()
    {
        $data = array();
        foreach ($this->dir as $key => $value) {

            $data = array_merge($data, $this->searchClass($value, $data));

        }

        $data = var_export($data, true);

        $data = "<?php

        return ".$data.";";
        file_put_contents (__DIR__."/classCache.php", $data);
    }

    private  function searchClass($fileDir, $data)
    {
        $data = array();
        $dir = opendir(dirname(__FILE__)."/../".$fileDir);

        while (($file = readdir($dir)) !== false)
        {

            $file = explode(".", $file);
            $fileName = $file[0];

            if ($fileName && isset($file[1]) && $file[1] ="php") {

                $namespace = $fileDir."/".$fileName;
                $namespace = str_replace("/", "\\", $namespace);
                $data[$namespace] = $fileDir."/".$fileName.".php";
            }else if ($fileName && $fileName != 'Twig') {

                $data = array_merge($data, $this->searchClass($fileDir."/".$fileName, $data));
            }
        }
        closedir($dir);
        return $data;
    }

}
