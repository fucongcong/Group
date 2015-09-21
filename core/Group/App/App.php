<?php
namespace core\Group\App;

use Exception;

class App
{
    public static function checkPath()
    {
        self::setIsCgi();
        self::setPhpFile();
        self::setRoot();
    }

    private function setIsCgi()
    {
        if(!defined('IS_CGI')) {

            define('IS_CGI',(0 === strpos(PHP_SAPI,'cgi') || false !== strpos(PHP_SAPI,'fcgi')) ? 1 : 0 );
        }

    }

    private function setPhpFile()
    {
        if(!defined('_PHP_FILE_')) {
            if(IS_CGI) {

                $_temp  = explode('.php',$_SERVER['PHP_SELF']);
                define('_PHP_FILE_',    rtrim(str_replace($_SERVER['HTTP_HOST'],'',$_temp[0].'.php'),'/'));
            }else {
                define('_PHP_FILE_',    rtrim($_SERVER['SCRIPT_NAME'],'/'));
            }
        }
    }

    private function setRoot()
    {
        $_root  =  __ROOT__;
    }

}