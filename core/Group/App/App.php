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

        'App'               => 'core\Group\App\App',
        'Cache'             => 'core\Group\Cache\Cache',
        'Config'            => 'core\Group\Config\Config',
        'Container'         => 'core\Group\Container\Container',
        'Controller'        => 'core\Group\Controller\Controller',
        'Dao'               => 'core\Group\Dao\Dao',
        'Filesystem'        => 'core\Group\Common\Filesystem',
        'FileCache'         => 'core\Group\Cache\FileCache',
        'Route'             => 'core\Group\Routing\Route',
        'Service'           => 'core\Group\Services\Service',
        'ServiceProvider'   => 'core\Group\Services\ServiceProvider',
        'Test'              => 'core\Group\Test\Test',
    ];

    public function __construct()
    {
        $this -> aliasLoader();
    }

    /**
     * init appliaction
     *
     */
    public function init()
    {
        $this -> container = Container::getInstance();
        $this -> container -> init();

        $this -> router = new Router();
        $this -> router -> match();
    }

    /**
     * do the class alias
     *
     */
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