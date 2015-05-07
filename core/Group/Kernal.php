<?php

namespace core\Group;

Class Kernal
{
    public function init()
    {   
        $rounting = include 'src/web/routing.php';

        $this->fix_gpc_magic();

        if ($rounting[$_SERVER['REQUEST_URI']]) {
            $rount = $rounting[$_SERVER['REQUEST_URI']];

            $rount = explode(':', $rount);

            require_once 'src/'.$rount[0].'/Controller/'.$rount[1].'/'.$rount[1].'Controller.php';

            $className = $rount[1].'Controller';

            $class = new $className();

            $action = $rount[2].'Action';

            echo $class->$action();
        } else {
            echo '404页面不存在';
        }
    }

    public function fix_gpc_magic()
    {
        static $fixed = false;
        if (!$fixed && ini_get('magic_quotes_gpc')) {
            array_walk($_GET, '_fix_gpc_magic');
            array_walk($_POST, '_fix_gpc_magic');
            array_walk($_COOKIE, '_fix_gpc_magic');
            array_walk($_REQUEST, '_fix_gpc_magic');
            array_walk($_FILES, '_fix_gpc_magic_files');
        }
        $fixed = true;
    }

    private static function _fix_gpc_magic(&$item) {
      if (is_array($item)) {
        array_walk($item, '_fix_gpc_magic');
      }
      else {
        $item = stripslashes($item);
      }
    }

    private static function _fix_gpc_magic_files(&$item, $key) {
      if ($key != 'tmp_name') {
        if (is_array($item)) {
          array_walk($item, '_fix_gpc_magic_files');
        }
        else {
          $item = stripslashes($item);
        }
      }
    }
}
