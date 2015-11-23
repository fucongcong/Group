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
        'Controller' => 'core\Group\Controller\Controller',
        'FileCache' => 'core\Group\Cache\FileCache',
        'Route'     => 'core\Group\Routing\Route',
        'Service' => 'core\Group\Services\Service',
        'ServiceProvider' => 'core\Group\Services\ServiceProvider',
    ];

    public function __construct()
    {
        $this -> aliasLoader();

        $this -> container = Container::getInstance();

        $this -> router = new Router();
    }

    public function init()
    {
        $this -> container -> init();
        $this -> router -> match();
    }

    public function aliasLoader()
    {
        $aliases = Config::get('app::aliases');
        $aliases = array_merge($aliases, $this ->aliases);
        AliasLoaderHandler::getInstance($aliases) -> register();

    }

    /**
    * return single class
    *
    * @return core\App\App App
    */
    public static function getInstance(){

        if(!(self::$_instance instanceof self)){

            self::$_instance = new self;
        }

        return self::$_instance;
    }

}