<?php
namespace core\Group\App;

use core\Group\Handlers\AliasLoaderHandler;
use core\Group\Config\Config;
use Exception;
use Container;
use core\Group\Routing\Router;

class App
{
    private static $_instance;

    protected $services;

    protected $container;

    protected $router;

    protected $aliases = [

        'App'       => 'core\Group\App\App',
        'Cache'     => 'core\Group\Cache\Cache',
        'Config'    => 'core\Group\Config\Config',
        'Container' => 'core\Group\Container\Container',
        'FileCache' => 'core\Group\Cache\FileCache',
        'Route'     => 'core\Group\Routing\Route',
        'Service' => 'core\Group\Services\Service',
        'ServiceProvider' => 'core\Group\Services\ServiceProvider',
    ];

    public function __construct()
    {
        $this -> aliasLoader();

        $this ->container = Container::getInstance();

        $this ->router = new Router();
    }

    public function init()
    {
        self::checkPath();
        $this ->container -> init();
        $this ->router -> match();
    }

    public function aliasLoader()
    {
        $aliases = Config::get('app::aliases');
        $aliases = array_merge($aliases, $this ->aliases);
        AliasLoaderHandler::getInstance($aliases) -> register();

    }

    public static function checkPath()
    {
        self::setIsCgi();
        self::setPhpFile();
        self::setRoot();
    }

    private static function setIsCgi()
    {
        if(!defined('IS_CGI')) {
            define('IS_CGI',(0 === strpos(PHP_SAPI,'cgi') || false !== strpos(PHP_SAPI,'fcgi')) ? 1 : 0 );
        }

    }

    private static function setPhpFile()
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

    private static function setRoot()
    {
        $_root = rtrim(dirname(_PHP_FILE_),'/');
        if(!defined('__ROOT__')) {
            define('__ROOT__',  (($_root=='/' || $_root=='\\')?'':$_root));
        }
    }

    /**
    * return single class
    *
    * @return core\APP\App APP
    */
    public static function getInstance(){

        if(!(self::$_instance instanceof self)){

            self::$_instance = new self;
        }

        return self::$_instance;
    }

}